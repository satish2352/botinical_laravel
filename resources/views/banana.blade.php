<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facility Cards</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #e7f2ec;
      font-family: 'Segoe UI', sans-serif;
    }
    .facility-card {
      border-radius: 15px;
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 25px;
    }
    .facility-title {
      color: #1e775b;
      font-weight: 600;
      margin-bottom: 15px;
    }
    .facility-card img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      margin: 0 auto 20px;
    }
    .facility-content p {
      font-size: 0.95rem;
      color: #444;
      text-align: justify;
    }
    .botanical-name {
      color: #1e775b;
      font-weight: 600;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row mb-3" style="background-color:#1e775b">
    <img src="./public/assets/static-images/LANSCAPE LOG.png" alt="Nature’s Hub Food Court" style="width: 251px; height: auto;">
  </div>

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="mt-3 text-end mb-3">
        <a href="{{ url('/plants') }}" class="btn text-white" style="background-color:#1e775b">
          Back <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

      <div class="facility-card text-center">
        <h5 class="facility-title">Banana</h5>
        <img src="./public/assets/static-images/1.jpg" alt="Nature’s Hub Food Court">
        <div class="facility-content">
          <p>
            Musa is one of three genera in the family Musaceae. The genus includes 83 species of flowering plants producing edible bananas and plantains. Though they grow as high as trees, banana and plantain plants are not woody and their apparent "stem" is made up of the bases of the huge leaf stalks.
          </p>
          <div class="botanical-name">Botanical Name: Musa</div>
        </div>
        <div class="mt-3 text-center mb-3">
          <a href="{{ url('/plants') }}" class="btn text-white" style="background-color:#1e775b">
            Direction <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
