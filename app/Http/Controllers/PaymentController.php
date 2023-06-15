<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\UserAsociates;

class PaymentController extends Controller
{
    public function show(){
        return view('pago');
    }

    public function handlePayment(Request $request)
    {
        // Guardar los detalles del usuario en la sesión
        $request->session()->put('user', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "9.99"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error', 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        // Recuperar los detalles del usuario de la sesión
        $userData = $request->session()->get('user');
    
        // Crear y guardar el usuario en la base de datos
        $user = UserAsociates::create([
            'name' => $userData['name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'username' => $userData['username'],
            'password' => $userData['password'],
            'address' => $userData['address'],
            'city' => $userData['city'],
            'zip_code' => $userData['zip_code'],
        ]);
    
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
    
        // Get the order ID
        $orderId = $request->get('token');
    
        // Retrieve the order details
        $response = $provider->showOrderDetails($orderId);
    
        // Check the order status
        if ($response['status'] == 'APPROVED') {
            // The payment was approved, now try to capture it
            $captureResponse = $provider->capturePaymentOrder($orderId);
    
            if ($captureResponse['status'] == 'COMPLETED') {
                // The payment was successfully captured
                $user->payment_confirmed = true;
                $user->save();
    
                return redirect()->intended('loginAsociados');
            } else {
                // The capture was not successful
                return redirect()
                    ->route('cancel.payment')
                    ->with('error', 'Payment capture failed.');
            }
        } else {
            return redirect()
                ->route('cancel.payment')
            ->with('error', 'Payment failed.');
        }
    }
    
    
}
