<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    /* Center website */
    .main {
      max-width: 1000px;
      margin: auto;
    }

    h2 {
      font-size: 50px;
      word-break: break-all;
    }

    .row {
      margin: 10px -16px;
    }

    /* Add padding BETWEEN each column */
    .row,
    .row > .column {
      padding: 8px;
    }

    /* Create three equal columns that float next to each other */
    .column {
      float: left;
      width: 33.33%;
    }

    /* Clear floats after rows */ 
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Content */
    .content {
      background-color: white;
      padding: 10px;
      position: relative;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .content img {
      width: 100%;
      height: 200px;
      cursor: pointer;
    }

    .content:hover {
      transform: scale(1.05);
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }
	
    /* Style the buttons */
    .btn {
      border: none;
      outline: none;
      padding: 12px 16px;
      background-color: #7EBB74;
      cursor: pointer;
      font-weight: bold;
      margin: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #ddd;
    }

    .btn:focus {
      background-color: #EEC945 ;
      color: black;
    }
	
	/* Add the following styles for the lightbox */
    .lightbox {
      display: none;
      position: fixed;
      z-index: 9999;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: rgba(0, 0, 0, 0.7);
    }

    .lightbox img {
      display: block;
      max-width: 100%;
      max-height: 100%;
      margin: auto;
      padding: 20px;
      box-sizing: border-box;
    }

    .lightbox .close {
      position: absolute;
      top: 20px;
      right: 20px;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
    }

    .lightbox .next,
    .lightbox .prev {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      color: #fff;
      font-size: 30px;
      cursor: pointer;
    }

    .lightbox .next {
      right: 20px;
    }

    .lightbox .prev {
      left: 20px;
    }
  </style>
</head>
<body>

<!-- MAIN (Center website) -->
<div class="main">

 <div id="myBtnContainer">
     <button id="selectAllBtn" class="btn" onclick="showAll()">Show All</button>
    <button class="btn" onclick="showAmenities()">Amenities</button>
    <button class="btn" onclick="showRooms()">Rooms</button>
    <button class="btn" onclick="showEvents()">Events</button>
  </div>
  <hr>
  <!-- Portfolio Gallery Grid -->
  <div class="row" id="gallery">

    <!-- Amenities Section -->
    <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/billiards.jpg" alt="Amenities 1">
        <h4>Billiards</h4>
        <p>Spend time with your family and friends playing billiards</p>
      </div>
    </div>
    <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/videoke.jpg" alt="Amenities 2">
        <h4>Videoke</h4>
        <p>Sing your heart and your emotions out with our videoke.</p>
      </div>
    </div>
    <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/jacuzzi.jpg" alt="Amenities 3">
        <h4>Jacuzzi</h4>
        <p>Relax and take away the stress with our Jacuzzi.</p>
      </div>
    </div>
	
	 <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/pool1.jpg" alt="Amenities 3">
        <h4>Pool</h4>
        <p>Relax and swim away the stress with our swimming pools.</p>
      </div>
    </div>
	 <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/dining1.jpg" alt="Amenities 3">
        <h4>Dining Area</h4>
        <p>Enjoy your favorite meals on our provided dining area.</p>
      </div>
    </div>
	 <div class="column amenities" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/kitchen.jpg" alt="Amenities 3">
        <h4>Kitchen</h4>
        <p>Cook your favorite dishes for your family here in our kitchen.</p>
      </div>
    </div>

    <!-- Rooms Section -->
    <div class="column rooms" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/room 5.jpg" alt="Rooms 1">
        <h4>Room 1</h4>
        <p>Relax and have a good sleep in our comfortable rooms.</p>
      </div>
    </div>
    <div class="column rooms" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/room 2.jpg" alt="Rooms 2">
        <h4>Room 2</h4>
        <p>Relax and have a good sleep in our comfortable rooms.</p>
      </div>
    </div>
    <div class="column rooms" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/room 3.jpg" alt="Rooms 3">
        <h4>Room 3</h4>
        <p>Relax and have a good sleep in our comfortable rooms.</p>
      </div>
    </div>

    <!-- Events Section -->
    <div class="column events" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/event.jpg" alt="Events 1">
        <h4>Wedding</h4>
        <p>Make your own memories here in our resort.</p>
      </div>
    </div>
    <div class="column events">
      <div class="content">
        <img src="assets/media/event5.jpg" alt="Events 2">
        <h4>Birthdays</h4>
        <p>Celebrate and enjoy your birthday with us! <br></p>
      </div>
    </div>
    <div class="column events" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/event 3.jpg" alt="Events 1">
        <h4>Reception</h4>
        <p>Entertain your guests and enjoy your event in our resort..</p>
      </div>
    </div>
    <div class="column events" style="width: 21rem;">
      <div class="content">
        <img src="assets/media/event4.jpg" alt="Events 2">
        <h4>Debut</h4>
        <p>Celebrate your Debut with your friends and family in our resort.</p>
      </div>
    </div>

</div>
<div class="lightbox" id="lightbox">
  <span class="close" onclick="closeLightbox()">&times;</span>
  <img src="" alt="" id="lightboxImage">
  <span class="prev" onclick="prevImage()">&#10094;</span>
  <span class="next" onclick="nextImage()">&#10095;</span>
</div>

<script>
  function showAll() {
    var gallery = document.getElementById("gallery");
    var sections = gallery.getElementsByClassName("column");
    for (var i = 0; i < sections.length; i++) {
      var section = sections[i];
      section.style.display = "block";
    }
  }

  function showAmenities() {
    var gallery = document.getElementById("gallery");
    var sections = gallery.getElementsByClassName("column");
    for (var i = 0; i < sections.length; i++) {
      var section = sections[i];
      if (section.classList.contains("amenities")) {
        section.style.display = "block";
      } else {
        section.style.display = "none";
      }
    }
  }

  function showRooms() {
    var gallery = document.getElementById("gallery");
    var sections = gallery.getElementsByClassName("column");
    for (var i = 0; i < sections.length; i++) {
      var section = sections[i];
      if (section.classList.contains("rooms")) {
        section.style.display = "block";
      } else {
        section.style.display = "none";
      }
    }
  }

  function showEvents() {
    var gallery = document.getElementById("gallery");
    var sections = gallery.getElementsByClassName("column");
    for (var i = 0; i < sections.length; i++) {
      var section = sections[i];
      if (section.classList.contains("events")) {
        section.style.display = "block";
      } else {
        section.style.display = "none";
      }
    }
  }
  
   window.addEventListener("load", function() {
    var selectAllBtn = document.getElementById("selectAllBtn");
    selectAllBtn.focus();
  });
  
  
  // Add the following functions for the lightbox
  var images = document.querySelectorAll('.content img');
  var lightbox = document.getElementById('lightbox');
  var lightboxImage = document.getElementById('lightboxImage');
  var currentIndex = 0;

  function openLightbox(index) {
    currentIndex = index;
    lightboxImage.src = images[index].src;
    lightbox.style.display = 'block';
  }

  function closeLightbox() {
    lightbox.style.display = 'none';
  }

  function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    lightboxImage.src = images[currentIndex].src;
  }

  function prevImage() {
    currentIndex = (currentIndex + images.length - 1) % images.length;
    lightboxImage.src = images[currentIndex].src;
  }

  // Attach click event handlers to the images
  for (var i = 0; i < images.length; i++) {
    images[i].addEventListener('click', function(index) {
      return function() {
        openLightbox(index);
      };
    }(i));
  }
</script>
</body>
</html>