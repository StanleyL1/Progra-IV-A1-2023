@extends('layouts.sitio')

@section('content')
<div class="container-fluid" >
    <h1 class="text-center mb-2">Complete su Compra</h1>
<div class="row justify-content-center text-center ">

    <div class="col-md-4 col-lg-4 " style="z-index: 6 !important;">
        <div class="card text-white mb-4" style="background-color: #1A2B4C;">
            <div class="card-header rounded-bottom  text-dark bg-white"><h5>Formulario de Pago</h5></div>
            <div class="card-body rounded-4" style="background-color: #1A2B4C;">
                <h5 class="text-start ">Pago con Paypal<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
                    <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z"/>
                  </svg></h5>
<!-- Formulario de Pago -->
<form id="paymentForm" action="{{ route('make.payment') }}" method="POST" style="background-color: #1A2B4C;">
    @csrf
    <div class="input-group mt-4">
        <input type="text" name="name" class="form-control me-1" placeholder="Nombre ">
        <input type="text" name="last_name" class="form-control ms-1" placeholder="Apellidos ">
    </div>
    <div class="input-group mt-4">
        <input type="email" name="email" class="form-control" placeholder="Correo electrónico ">
    </div>
    <div class="input-group  mt-4">
        <input type="text" name="username" class="form-control" placeholder="Nombre de Usuario">
    </div>
    <div class="input-group  mt-4">
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
    </div>
    <div class="input-group mt-4">
        <input type="text" name="address" class="form-control" placeholder="Direccion">
    </div>
    <div class="input-group mt-4">
        <input type="text" name="city" class="form-control me-1" placeholder="Ciudad ">
        <input type="text" name="zip_code" class="form-control ms-1" placeholder="Codigo Postal ">
    </div>
    
</form>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 text-start">
        <div class="card mb-3">
            <div class="card-header"><h5>Resumen</h5></div>
            <div class="card-body">
                <p class="card-text">Standar</p>
                <p class="card-text">9.99 US$ único pago</p>
                <div class="row text-center border-top border-bottom  border-secondary m-5">
                    <div class="p-1 col col-md-6"><h4 style="font-weight: bold;" class="card-title">Total</h4></div>
                    <div class="p-1 col col-md-6"><h4 style="font-weight: bold;" class="card-title">9.99 US$</h4></div>
                </div>
                <div class="row m-5">
                    <button type="submit" style="background-color: #1A2B4C;" class="btn btn-primary btn-block " onclick="submitForm()">Pagar con Paypal  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                      </svg></button>
                </div>
                <div class="row m-4 text-center">
                    <p style="font-weight: bold;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
                      </svg> Pago Seguro</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@section('scripts')
<script>
function submitForm() {
    document.getElementById('paymentForm').submit();
}
</script>
@endsection
@endsection
