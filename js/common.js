'use strict'

/**
 * 単語登録フォームの表示
 */
const toggleAddForm = () => {
  const input = {
    wrap: document.getElementsByClassName('input_wrap')[0],
    inner: document.getElementsByClassName('input_inner')[0],
    showButton: document.getElementsByClassName('input_button')[0]
  }

    input.showButton.addEventListener('click', function() {
      input.wrap.classList.toggle('is_show');
    })
  
    input.wrap.addEventListener('click', function() {
      this.classList.remove('is_show');
    })
  
    input.inner.addEventListener('click', function(e) {
      e.stopPropagation(); 
    },)
}

/**
 * 詳細エリア表示
 */
const toggleDetail = () => {
  const word = {
    item: document.getElementsByClassName('words_item'),
    itemLength: document.getElementsByClassName('words_item').length
  }
  const styleProperty = {
    zeroPx : '0px',
    auto : 'auto'
  }

  for (let i = 0; i < word.itemLength; i++) {
    const elWordItem = word.item[i];
    const elToggleDetail = elWordItem.getElementsByClassName('js_toggle_detail');
    const elToggleDetailLength = elToggleDetail.length;
    const elWordItemDetail = elWordItem.getElementsByClassName('words_detail')[0];
    elWordItemDetail.style.height = styleProperty.auto;
    const detailHeight = elWordItemDetail.offsetHeight;
    elWordItemDetail.style.height = styleProperty.zeroPx;

    for (let j = 0; j < elToggleDetailLength; j++) {
      elToggleDetail[j].addEventListener('click', function() {
        elWordItem.classList.toggle('is_show');
        if (elWordItemDetail.style.height === styleProperty.zeroPx) {
          elWordItemDetail.style.height = `${detailHeight}px`;
        } else {
          elWordItemDetail.style.height = styleProperty.zeroPx;
        }
      })
    }
  }
}

document.addEventListener('DOMContentLoaded', function() {
  toggleAddForm();
});
window.addEventListener('load', function() {
  toggleDetail();
});