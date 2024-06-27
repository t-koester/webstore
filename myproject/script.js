const MongoClient = require('mongodb').MongoClient;

// Replace <password> with the actual password
const url = 'mongodb+srv://admin:admin@cluster0.umvjrii.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
MongoClient.connect(url, function(err, client) {
  if (err) {
    console.log(err);
  } else {
    console.log('Connected to MongoDB');

    // Create a database object
    const db = client.db();

    // List all collections in the database
    db.listCollections().toArray(function(err, collections) {
      console.log(collections);
    });

    // Close the client
    client.close();
  }
});

try {
    MongoClient.connect(url, function(err, client) {
      if (err) {
        console.log(err);
      } else {
        console.log('Connected to MongoDB');
  
        // Create a database object
        const db = client.db();
  
        // List all collections in the database
        db.listCollections().toArray(function(err, collections) {
          console.log(collections);
        });
  
        // Close the client
        client.close();
      }
    });
  } catch (e) {
    console.error(e);
  }