<?php include('../include/db.php'); ?>
<?php include('../include/header.php'); ?>

<style>
    ul {
        list-style-type: none;
        padding-left: 0;
    }

    li {
        background-color: #f0f0f0;
        margin: 5px 0;
        padding: 10px;
        border-radius: 5px;
    }
</style>


<main style="padding: 20px; max-width: 600px; margin: auto;">
    <h2>💬 Inventory Chatbot</h2>
    <form id="chat-form">
        <input type="text" name="question" id="question" placeholder="Ask something like 'show all products'" required style="width: 100%; padding: 10px;">
        <button type="submit" style="margin-top: 10px;">Send</button>
    </form>
    <div id="response" style="margin-top: 20px; font-weight: bold;"></div>
</main>

<script>
    const form = document.getElementById('chat-form');
const responseBox = document.getElementById('response');

form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    const res = await fetch('../backend/chatbot.php', {
        method: 'POST',
        body: formData
    });
    const text = await res.text();
    responseBox.innerHTML = text;  // Use innerHTML to render the HTML list
});

</script>

<?php include('../include/footer.php'); ?>
