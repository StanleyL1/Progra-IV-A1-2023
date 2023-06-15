const express = require('express'),
    server = express(),
    http = require('http').Server(server),
    io = require('socket.io')(http, {
        allowEIO3:true,
        cors:{
            origin: ['http://127.0.0.1:8000', 'http://localhost:8000'],
            credentials:true,
        }
    }),
    { MongoClient } = require('mongodb'),
    multer = require('multer'),
    url = 'mongodb://127.0.0.1:27017/',
    dbname = 'norrisDB',
    client = new MongoClient(url),
    port = 3000,
    upload = multer({ 
        dest: 'uploads/', 
        fileFilter: (req, file, cb) => {
            if (file.mimetype.startsWith('audio/') || file.mimetype.startsWith('image/') || file.mimetype === 'application/msword' || file.mimetype === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                cb(null, true);
            } else {
                cb(new Error('Tipo de archivo no permitido'), false);
            }
        }
    });

// Función para conectar a la base de datos
async function conectarBD(){
    await client.connect();
    return client.db(dbname);
}

server.use(express.json());

// Ruta para cargar archivos
server.post('/upload', upload.single('file'), (req, res) => {
  if (!req.file) {
    return res.status(400).send('No se cargó ningún archivo');
  }
  res.status(200).send('Archivo cargado con éxito');
});

io.on('connect', socket => {
  console.log('server conectado...');

  socket.on('userConnected', ({ userId, chatId }) => {
    socket.join('chat_' + userId + '_' + chatId);
  });

  socket.on('chat', async chat => {
    let db = await conectarBD(),
        collection = db.collection('chat');
    chat.status = 'enviado';
    // Asegúrate de que estás utilizando el messageId proporcionado
    chat._id = chat.messageId;
    const result = await collection.insertOne(chat);
    io.to('chat_' + chat.from + '_' + chat.to).emit('chat', chat);
    io.to('chat_' + chat.to + '_' + chat.from).emit('chat', chat);
  });

  socket.on('historial', async ({ userId, chatId }) => {
    let db = await conectarBD(),
        collection = db.collection('chat'),
        chat = await collection.find({ chatId: chatId }).toArray();
    socket.emit('historial', chat);
  });

  socket.on('messageReceived', async ({ messageId }) => {
    let db = await conectarBD(),
    collection = db.collection('chat');
await collection.updateOne({ _id: messageId }, { $set: { status: 'recibido' } });
  });

  socket.on('messageRead', async ({ messageId }) => {
    let db = await conectarBD(),
    collection = db.collection('chat');
await collection.updateOne({ _id: messageId }, { $set: { status: 'leido' } });
  });
});

http.listen(port, ()=>{
    console.log('Server corriendo en el puerto ', port);
});
