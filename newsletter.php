<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Newsletter Signup</h1>
        <form id="newsletter-form">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="name">Name (optional):</label>
            <input type="text" id="name" name="name">
            <button type="submit">Subscribe</button>
        </form>
        <div id="response"></div>
    </div>

    <script>
        const form = document.getElementById('newsletter-form');
        const responseDiv = document.getElementById('response');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const name = document.getElementById('name').value;

            try {
                // Replace with your own API or backend logic
                const response = await fetch('/subscribe', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, name }),
                });

                const result = await response.json();
                responseDiv.innerHTML = `Thank you for subscribing!`;
            } catch (error) {
                responseDiv.innerHTML = `Error: ${error.message}`;
            }
        });
    </script>
</body>
</html>