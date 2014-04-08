var databaseUrl = "admin"; 
var collections = ["inventory"];
var db = require("mongojs").connect(databaseUrl, collections);

db.inventory.find({title: "gold chain"}, function(err, users) {
  if( err || !users) console.log("Not found");
  else users.forEach( function(femaleUser) {
    console.log(femaleUser);
document.write(femaleUser);
  } );
});

