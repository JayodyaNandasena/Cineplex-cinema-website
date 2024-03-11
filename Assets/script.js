let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); 
}

function playTrailer(trailerLink) {
  // Check if trailer link starts with YouTube embed URL format
  if (trailerLink.startsWith("https://www.youtube.com/embed/")) {
    console.log("ok");  
    document.getElementById('trailer-embed').innerHTML = `<iframe width="560" height="315" src="${trailerLink}" frameborder="0" allowfullscreen></iframe>`;
  } else {
    // Handle cases where trailer link might not be a YouTube embed
    console.log("Invalid trailer link format. Expected YouTube embed URL.");
    // Optionally display an error message to the user
  }
  document.getElementById('trailer-embed').style.display = 'block';
}

const addScheduleButton = document.getElementById("addScheduleButton");

addScheduleButton.addEventListener("click", function() {
  event.preventDefault(); // Prevent default form submission

  const schedulingDiv = document.getElementById("scheduling");
  const clonedSchedulingDiv = schedulingDiv.cloneNode(true); // Clone the scheduling div

  // Update name attributes of cloned inputs to avoid conflicts during form submission
  const clonedInputs = clonedSchedulingDiv.querySelectorAll("input[type='date'], select");
  clonedInputs.forEach(input => {
    const originalName = input.getAttribute("name");
    const newName = originalName.slice(0, -2) + "[]"; // Add square brackets for multiple values
    input.setAttribute("name", newName);
  });

  schedulingDiv.parentNode.insertBefore(clonedSchedulingDiv, schedulingDiv.nextSibling); // Insert the cloned div after the original
});



