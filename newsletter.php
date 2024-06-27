<html>
  <head>
    <title>Newsletter Anmeldung</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
      }
      .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }
      .header h1 {
        margin: 0;
      }
      .form-group {
        margin-bottom: 20px;
      }
      .form-group label {
        display: block;
        margin-bottom: 10px;
      }
      .form-group input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
      }
      .form-group button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      .form-group button[type="submit"]:hover {
        background-color: #3e8e41;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Newsletter Anmeldung</h1>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="email">Email Addresse:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <button type="submit" name="submit">Sign up</button>
        </div>
      </form>
      <p>Melde dich jetzt an!</p>
    </div>
  </body>
</html>