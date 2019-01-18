// MySQL API
var apis = '../OMG/Controller/GanttTareasController.php'; 

// set image directori
var imageDir = 'image';

// Replace with: your firebase account
//var config = {
//    apiKey: "AIzaSyDfKpgAUCOja3z-tc0yHOqzOCEGo0seJAQ",
//    databaseURL: "https://chatws-40480.firebaseio.com"
//};
var config = {
    apiKey: "AIzaSyAhszpIRh8BBXtzSbu1yhGziYX-uT5pPak",
    authDomain: "notasgantttareas-temas.firebaseapp.com",
    databaseURL: "https://notasgantttareas-temas.firebaseio.com",
    projectId: "notasgantttareas-temas",
    storageBucket: "notasgantttareas-temas.appspot.com",
    messagingSenderId: "1061411526028"
  };
firebase.initializeApp(config);

// create firebase child
var dbRef = firebase.database().ref();
	messageRef = dbRef.child('notasgantttareas-temas');
//	userRef = dbRef.child('user');
//messageRef="g";
//userRef="hdelangel";


