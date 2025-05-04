<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plants</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
  .facility-body {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: flex;
  }
  .facility-card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
  }
  .facility-content p {
    margin: 0;
    font-size: 0.95rem;
    color: #444;
    /* text-align: justify; */
  }

  .read-more-content {
    max-height: 80px;
    overflow: hidden;
    transition: max-height 0.3s ease;
  }
  .read-more-content.expanded {
    max-height: 500px; /* adjust based on content length */
  }
  </style>
</head>
<body>

<div class="container">
  <div class="row mb-3" style="background-color:#1e775b" >
    <img src="./public/assets/static-images/LANSCAPE LOG.png" alt="Nature’s Hub Food Court" style="width: 251px;
    height: auto;">
  </div>
  <h5 class="facility-title">Explore Our Plants </h5>
  <div class="row mb-4">
    <div class="col-md-6 offset-md-3 d-flex align-items-center gap-2">
      <input type="text" id="searchInput" class="form-control" placeholder="Search plant by name...">
      <a href="" class="btn text-white" style="background-color:#1e775b">Search <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
  </div>
  
  <div class="row">
  
    <div class="col-lg-6 col-md-6 col-md-6">
      <div class="facility-card">
        <h5 class="facility-title">Mango</h5>
        <div class="facility-body">
          <img src="./public/assets/static-images/1.jpg" alt="Nature’s Hub Food Court">
          <div class="facility-content">
            <p>Mangifera indica, commonly known as mango, is a species of flowering plant in the family Anacardiaceae. It is a large fruit tree, capable of growing to a height of 30 metres. </p>
            <h6 class="facility-title">Botnical Name : Mangifera indica</h6>
            <a href="{{ url('/mango') }}" class="btn btn-sm btn-outline-success mt-2">Read More</a>

          </div>
        
        </div>
        
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-md-6">
      <div class="facility-card">
        <h5 class="facility-title">Apple</h5>
        <div class="facility-body">
          <div class="facility-content">
            <p>Malus is a genus of about 32–57 species of small deciduous trees or shrubs in the family Rosaceae, including the domesticated orchard apple, crab apples and wild apples.</p>
            <h6 class="facility-title">Botnical Name : Malus</h6>
            <a href="{{ url('/apple') }}" class="btn btn-sm btn-outline-success mt-2">Read More</a>
          </div>
          <img src="./public/assets/static-images/2.jpg" alt="Nature’s Hub Food Court">
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-md-6">
      <div class="facility-card">
        <h5 class="facility-title">Chickoo</h5>
        <div class="facility-body">
          <img src="./public/assets/static-images/3.jpg" alt="Nature’s Hub Food Court">
          <div class="facility-content">
            <p>Manilkara zapota, commonly known as sapodilla, sapote, chicozapote, chicoo, chicle, naseberry, nispero, or soapapple, among other names, is an evergreen tree native to southern Mexico and Central America.</p>
            <h6 class="facility-title">Botnical Name : Manilkara zapota</h6>
            <a href="{{ url('/chickoo') }}" class="btn btn-sm btn-outline-success mt-2">Read More</a>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-md-6">
      <div class="facility-card">
        <h5 class="facility-title">Banana</h5>
        <div class="facility-body">
          <div class="facility-content">
            <p>Musa is one of three genera in the family Musaceae. The genus includes 83 species of flowering plants producing edible bananas and plantains. Though they grow as high as trees, banana and plantain plants are not woody....</p>
            <h6 class="facility-title">Botnical Name : Musa</h6>
            <a href="{{ url('/banana') }}" class="btn btn-sm btn-outline-success mt-2">Read More</a>
          </div>
          <img src="./public/assets/static-images/4.jpg" alt="Nature’s Hub Food Court">
        </div>
      </div>
    </div>
  
    
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
