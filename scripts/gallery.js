const gallery1 = {
  galleryId: "galeria1",
  photos: [
    {
      photoNumber: 0,
      path: "./gallery/gallery-1.jpg",
      description: "Bolid Politechniki Rzeszowskiej"
    },
    {
      photoNumber: 1,
      path: "./gallery/gallery-2.jpg",
      description: "Sekcja Social Media"
    },
    {
      photoNumber: 2,
      path: "./gallery/gallery-3.jpg",
      description: "Ostatnie sprawdzenie przed rozpoczęciem"
    },
    {
      photoNumber: 3,
      path: "./gallery/gallery-4.jpg",
      description: "Przemysłowy Robot Pneumatyczny"
    },
    {
      photoNumber: 4,
      path: "./gallery/gallery-5.jpg",
      description: "Kilka chwil przez startem"
    },
    {
      photoNumber: 5,
      path: "./gallery/gallery-6.jpg",
      description: "Ocena prezentowanych projektów"
    }
  ]
}

function showGalleryBox() {
  
  let gallery = document.getElementById("galleryBox");
  if (gallery.style.opacity == 1) {
    gallery.style.opacity = 0;
    setTimeout(function() { 
      gallery.style.display = "none";
    }, 300);
  } else {
    gallery.style.display = "flex";
    setTimeout(function() { 
      gallery.style.opacity = 1;
    }, 10);
  }
}


function setUpGalleries() {

  let galleryStructure = "<ul>";

  for (photo of gallery1.photos) {
    galleryStructure += "<li><img src=\"" + photo.path + "\" /></li>";
  }

  galleryStructure += "</ul>"

  document.getElementById("gallery").innerHTML = galleryStructure

  let liGallery = document.querySelectorAll("#gallery > ul > li");

  Array.from(liGallery).forEach(liPhoto => {
      liPhoto.addEventListener('click', function(e) {
          photoClicked(liPhoto);
      });
  });

}

function photoClicked(p) {
  showGalleryBox();
  let currentImage = "";
  for (photo of gallery1.photos) {
    console.log(p.firstChild.attributes.src)
    if (photo.path == p.firstChild.attributes.src.nodeValue) currentImage = photo;
  }
  document.getElementById("imgDescription").innerHTML = currentImage.description;
  document.getElementById("imgBox").innerHTML = p.innerHTML;
}

function previousPhoto(event) {
  let currentImage = document.getElementById("imgBox");
  const currentImagePath = currentImage.firstChild.attributes.src.nodeValue;
  let currentImageNumber = 0;
  for (photo of gallery1.photos) {
    if (photo.path == currentImagePath) currentImageNumber = photo.photoNumber;
  }
  if (currentImageNumber == 0) currentImageNumber = gallery1.photos.length;
  document.getElementById("imgDescription").innerHTML = gallery1.photos[currentImageNumber - 1].description;
  document.getElementById("imgBox").innerHTML = "<img src=\"" + gallery1.photos[currentImageNumber - 1].path + "\" />"
}

function nextPhoto(event) {
  let currentImage = document.getElementById("imgBox");
  const currentImagePath = currentImage.firstChild.attributes.src.nodeValue;
  let currentImageNumber = 0;
  for (photo of gallery1.photos) {
    if (photo.path == currentImagePath) currentImageNumber = photo.photoNumber;
  }
  if (currentImageNumber >= gallery1.photos.length - 1 ) currentImageNumber = -1;
  document.getElementById("imgDescription").innerHTML = gallery1.photos[currentImageNumber + 1].description;
  document.getElementById("imgBox").innerHTML = "<img src=\"" + gallery1.photos[currentImageNumber + 1].path + "\" />"
}

document.getElementById("galleryBox").addEventListener("click", function() {
  if (event.target != document.getElementById("galleryBox")) return;
  showGalleryBox();
})

document.addEventListener("keydown", function(e) {
  if (e.keyCode === 37 && document.getElementById("galleryBox").style.opacity == 1) {
    previousPhoto(e);
  }
})

document.addEventListener("keydown", function(e) {
  if ((e.keyCode === 38 || e.keyCode === 40) && document.getElementById("galleryBox").style.opacity == 1) {
    showGalleryBox();
  }
})

document.addEventListener("keydown", function(e) {
  if (e.keyCode === 39 && document.getElementById("galleryBox").style.opacity == 1) {
    nextPhoto(e);
  }
})

document.getElementById("galleryLeft").addEventListener("click", function(e) {
  previousPhoto(e);
})

document.getElementById("galleryClose").addEventListener("click", function(e) {
  showGalleryBox();
})

document.getElementById("galleryRight").addEventListener("click", function(e) {
  nextPhoto(e);
})

window.addEventListener('DOMContentLoaded', (event) => {
  setUpGalleries();
});
