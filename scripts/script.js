const animItems = document.querySelectorAll('._anim-items');

if (animItems.length > 0) {
  window.addEventListener('scroll', animOnScroll);
  function animOnScroll(){
    for (let index = 0; index < animItems.length; index++) {
      const animItem = animItems[index];
      const animItemHeight = animItem.offsetHeight;
      const animItemOffset = offset(animItem).top;
      const animStart = 10;

      let animItemPoint = window.innerHeight - animItemHeight / animStart;
      if (animItemHeight > window.innerHeight) {
        animItemPoint = window.innerHeight - window.innerHeight / animStart;
      }

      if ((pageYOffset > animItemOffset - animItemPoint)) {
        animItem.style.setProperty('--i', (index%3));
        animItem.classList.add('_active');
      } else {
        if (!animItem.classList.contains('_anim-no-hide')) {
          animItem.classList.remove('_active');
        }

      }
    }
  }

  function offset(el) {
    const rect = el.getBoundingClientRect(),
      scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft}
  }
  setTimeout(() => {
    animOnScroll();
  }, 300);
}

/*
var background = document.getElementsByClassName('backgroundImage');
var color = document.getElementsByClassName('colorSwitch');
color[0].forEach(input => input.addEventListener('change', handleUpdate()));
color[0].forEach(input => input.addEventListener('mousemove', handleUpdate()));

function handleUpdate(el) { // 7
  if (this.type === 'color') {
    background[0].style.setProperty('--color-switch', this.value);
  }
}
*/















/*
let articles = document.querySelectorAll('.article');
let swapped;
function bubbleSort(el) {
  swapped = false;
  let end = el.length - 1;
  for(let i = 0, j = 1; i < end; i++, j++) {
    if(el[i] > el[j]) {
      swapped = true;
      [el[i], el[j] = el[j], el[i]];
    }
  }
  end--;
}

do {
  bubbleSort(articles);
} while (swapped);

console.log(articles);
*/
