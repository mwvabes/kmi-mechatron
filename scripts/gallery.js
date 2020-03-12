


const images = document.querySelectorAll(".gallery > ul > li")
for (const image of images) {
  image.addEventListener('click', function(e) {
    console.log(e)
  })
}
