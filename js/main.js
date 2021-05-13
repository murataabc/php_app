'use strict';

{
    const calc_tax = document.querySelector("form[name='calc']");
    const selectedlists = [];
    calc_tax.addEventListener('submit', e => {
        e.preventDefault();
        selectedlists.length = 0;
        const all_li = document.querySelectorAll('li');
        const id_datas = document.querySelectorAll("input[name='id_datas[]']");
        id_datas.forEach(id_data => {
          if (id_data.checked === true) {
            selectedlists.push(id_data.value);
          }
        });
        all_li.forEach(li=>{
          li.remove();
        })
        selectedlists.forEach(selectedlist=>{
          const li = document.createElement('li');
          const tax = document.getElementById(selectedlist).children[1].textContent;
          const amount = document.querySelector("input[name='amount']").value;
          const calc = (parseInt(tax) * 0.01 + 1) * parseInt(amount);
          li.textContent = `消費税${tax}%のとき、${calc}円です。`;
          document.querySelector('ul').appendChild(li);
        })
    });
}
