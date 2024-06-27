// Import the MongoDB Node.js driver
const MongoClient = require('mongodb').MongoClient;
console.log(err);

// Set the connection URL
const url = 'ongodb+srv://admin:admin@cluster0.umvjrii.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
console.log(err);

// Connect to the MongoDB Atlas cluster
MongoClient.connect(url, function(err, client) {
  if (err) {
    console.log(err);
  } else {
    console.log('Connected to MongoDB Atlas cluster');

    // Get a reference to the database
    const db = client.db();

    // Perform some operations (e.g., insert a document)
    db.collection('mycollection').insertOne({ name: 'John Doe', age: 30 }, function(err, result) {
      if (err) {
        console.log(err);
      } else {
        console.log('Inserted document:', result);

        // Log the documents before update
        db.collection('mycollection').find().toArray(function(err, documents) {
          console.log('Documents:', documents);
        });
      }
    });

    // Close the client
    client.close();
  }
});