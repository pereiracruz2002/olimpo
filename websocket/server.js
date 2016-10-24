// Utilizaremos o app para inicializar o Express que será nossa função para fornecer um servidor HTTP
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql      = require('mysql');

var salas = [];

var usuarios = [];


var connection = mysql.createConnection({
  host     : 'facileme2',
  user     : 'petfans',
  password : 'meuapppet10',
  database : 'petfans'
});


connection.connect(function(err){
  if(!err) {
    console.log("Database is connected ... nn");    
  } else {
    console.log("Error connecting database ... nn");    
  }
});


// Definimos aqui uma rota "/" que será chamada quando acessarmos a página inicial da nossa aplicação
app.get('/', function(req, res){
  res.send('<h1>Servidor foi Iniciado!</h1>');
});


io.on('connection', function(socket){
  console.log('Usuário conectado.');


  socket.on("entrou", function(data) {

  	console.log("Um usuário se conectou a sala");

  	socket.join(data.sala);

  	usuarios[socket] = data.animal;

  	console.log(usuarios);

  });

  socket.on("sair",function(data){

  	console.log("Usúario saiu da conversa");

  	socket.leave(data.sala);

  	delete(usuarios[socket]);

  	console.log(usuarios);

  });

  socket.on('disconnect', function(){
    console.log('O usuário saiu da aplicação.');
  });

  socket.on("envia-mensagem",function(data){
  	console.log("envia-mensagem");
  	var sala = data.sala;
  	var mensagem = data.mensagem;
  	var animais_id = data.animais_id;

/*
  	connection.query('SELECT * from users LIMIT 2', function(err, rows, fields) {
  	connection.end();
  	  if (!err)
  	    console.log('The solution is: ', rows);
  	  else
  	    console.log('Ocorreu um erro na busca.');
  	  });
  */

  var datetime = new Date();

  var dia = datetime.getDate();
  if (dia.toString().length == 1)
    dia = "0"+dia;
  var mes = datetime.getMonth()+1;
  if (mes.toString().length == 1)
    mes = "0"+mes;
  var ano = datetime.getFullYear(); 
  var dataformatada = ano+"-"+mes+"-"+dia;






  hora = dataformatada+" "+datetime.getHours()+':'+datetime.getMinutes()+":"+datetime.getSeconds();

  var post  = {"sala":sala,  "mensagem":mensagem, "animais_id": animais_id,"created_at":hora,"updated_at":hora};
  var query = connection.query('INSERT INTO conversas_combinacoes SET ?', post, function(err, result) {
  	  // Neat!
  	});
  	console.log(query.sql); // INSERT INTO posts SET `id` = 1, `title` = 'Hello MySQL'


    //socket.broadcast.to(sala).emit('adicionaMensagem', {"hora": hora, "mensagem":mensagem, "animais_id": animais_id});

     io.to(sala).emit('adicionaMensagem', {"hora": hora, "mensagem":mensagem, "animais_id": animais_id});

  });




});


// Definimos a porta 3000 para nos servir a aplicação
http.listen(3000, function(){
  console.log('listening on *:3000');
});
