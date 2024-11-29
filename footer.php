<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Birthday and Gender</title>
    <link rel="stylesheet" href="css/footer.css"> 
</head>
<body>
<footer>
  <div class="footer-main">
      <div class="footer-left">
          <a href="#" class="uni-logo"><img src="Images/uni_logo.png" alt="University Logo" class="uni-logo"></a> 
      </div>
      <div class="footer-right">
          
          <a href="ticket_page.php"><img src="Images/ticket_icon.png" alt="Ticket" class="ticket-icon"></a> 
      </div>
  </div>
  <div class="footer-bottom">
      <hr><br>
      <p>&copy; 2024 Website. All rights reserved.</p>
      <button id="scrollToTop" class="scroll-top-button">
          <img src="Images/up_arrow.png" alt="Scroll to top" class="scroll-icon"> 
      </button>
  </div>
</footer>


<script>
    document.getElementById('scrollToTop').onclick = function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
</script>
</body>
</html>
