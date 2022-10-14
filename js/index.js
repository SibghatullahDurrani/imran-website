const upload_slideshow = document.getElementsByClassName("upload-label");
const upload_success_div = document.querySelectorAll("#success");
const exist_error_div = document.querySelectorAll("#exists-error");
const not_image_div = document.querySelectorAll("#not-image-error");
const incorrect_format_div = document.querySelectorAll(
  "#incorrect-format-error"
);
const upload_error_div = document.querySelectorAll("#upload-error");
const cancel_prompt = document.querySelectorAll("#cancel-prompt");
const edit_content_modal = document.querySelector(".edit-content-modal");
const edit_2 = document.getElementById("edit2");
const edit_3 = document.getElementById("edit3");
const modal_close = document.getElementById("modal-close");
const update_content_image_3 = document.getElementById("edit_image_btn");
const update_events_btn = document.getElementById("update-events");
const upload_members_btn = document.getElementById("members-upload-label");
const edit_members_modal = document.querySelector(".edit-members-modal");

function bindScroll() {
  $("html, body").animate({ scrollTop: 0 }, "fast");
  $("body").css({ overflow: "hidden" });
  $(document).bind("scroll", function () {
    window.scrollTo(0, 0);
  });
}
// function to unlock scroll on phones on modal popup
function unbindScroll() {
  $(document).unbind("scroll");
  $("body").css({ overflow: "visible" });
}

//function to create cookies
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function hidePrompt() {
  upload_success_div.forEach((action) => {
    action.style.display = "none";
  });
  exist_error_div.forEach((action) => {
    action.style.display = "none";
  });
  not_image_div.forEach((action) => {
    action.style.display = "none";
  });
  incorrect_format_div.forEach((action) => {
    action.style.display = "none";
  });
  upload_error_div.forEach((action) => {
    action.style.display = "none";
  });
}

for (const upload of upload_slideshow) {
  upload.addEventListener("click", () => {
    setCookie("Type", "1", 1);
  });
}
// upload_slideshow.addEventListener("click", () => {
//   setCookie("Type", "1", 1);
// });

let slideIndex = 1;
showSlides(slideIndex);

// Next previous controls
function plusSlides(n) {
  showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides((slideIndex = n));
}

// var interval = setInterval(function () {
//   document.querySelector(".next").click();
// }, 6000);

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  // let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  // for (i = 0; i < dots.length; i++) {
  //   dots[i].className = dots[i].className.replace(" active", "");
  // }
  slides[slideIndex - 1].style.display = "block";
  // dots[slideIndex-1].className += " active";
}
edit_2.addEventListener("click", () => {
  edit_content_modal.style.display = "flex";
  setCookie("Type", "2", 1);
  bindScroll();
});
edit_3.addEventListener("click", () => {
  edit_content_modal.style.display = "flex";
  setCookie("Type", "3", 1);
  bindScroll();
});
modal_close.addEventListener("click", () => {
  edit_content_modal.style.display = "none";
  unbindScroll();
});
update_content_image_3.addEventListener("click", () => {
  setCookie("Type", "3", 1);
});
update_events_btn.addEventListener("click", () => {
  document.querySelector(".edit-events-modal").style.display = "flex";
  bindScroll();
});
document.querySelector(".event-upload-label").addEventListener("click", () => {
  setCookie("Type", "4", 1);
});
document.getElementById("event-modal-close").addEventListener("click", () => {
  document.querySelector(".edit-events-modal").style.display = "none";
  unbindScroll();
});

let event_slideIndex = 1;
event_showSlides(event_slideIndex);

// Next/previous controls
function event_plusSlides(n) {
  event_showSlides((event_slideIndex += n));
}

// Thumbnail image controls
function event_currentSlide(n) {
  event_showSlides((event_slideIndex = n));
}

function event_showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("event-mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {
    event_slideIndex = 1;
  }
  if (n < 1) {
    event_slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" event-active", "");
  }
  slides[event_slideIndex - 1].style.display = "block";
  dots[event_slideIndex - 1].className += " event-active";
  captionText.innerHTML = dots[event_slideIndex - 1].alt;
}

upload_members_btn.addEventListener("click", () => {
  bindScroll();
  edit_members_modal.style.display = "flex";
});

document
  .querySelector(".members-upload-label")
  .addEventListener("click", () => {
    setCookie("Type", "5", 1);
  });
document.getElementById("members-modal-close").addEventListener("click", () => {
  edit_members_modal.style.display = "none";
  unbindScroll();
});

var members_slideIndex = 1;
members_showSlides(members_slideIndex);

function members_plusSlides(n) {
  members_showSlides((members_slideIndex += n));
}

function members_currentSlide(n) {
  members_showSlides((members_slideIndex = n));
}

function members_showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("members-mySlides");
  var dots = document.getElementsByClassName("members-dot");
  if (n > slides.length) {
    members_slideIndex = 1;
  }
  if (n < 1) {
    members_slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[members_slideIndex - 1].style.display = "block";
  dots[members_slideIndex - 1].className += " active";
}
