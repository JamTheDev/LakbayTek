<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }


    .video-wrapper {
      position: relative;
      max-width: 100%;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
    }

    .video-wrapper video {
      width: 100%;
      display: block;
    }

    .video-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
      cursor: pointer;
    }

    .video-wrapper:hover .video-overlay {
      opacity: 1;
    }

  </style>
</head>
<body>
  <div class="main">
    <div class="video-wrapper">
      <video src="assets/media/vid1.mp4" autoplay muted loop></video>
      <div class="video-overlay">
        <div class="play-button"></div>
      </div>
    </div>

  </div>

  <script>
    const videoWrapper = document.querySelector('.video-wrapper');
    const video = videoWrapper.querySelector('video');
    const playButton = videoWrapper.querySelector('.play-button');

    // Play or pause the video when clicking the play button or the video overlay
    playButton.addEventListener('click', toggleVideoPlay);
    videoWrapper.addEventListener('click', toggleVideoPlay);

    function toggleVideoPlay() {
      if (video.paused) {
        video.play();
        playButton.style.display = 'none';
      } else {
        video.pause();
        playButton.style.display = 'flex';
      }
    }
  </script>
</body>
</html>
