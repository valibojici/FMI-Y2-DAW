window.onload = ()=>{
    let update_form = document.getElementById('update_form');
    let insert_form = document.getElementById('insert_form');
    update_form.classList.add('d-none');

    let cancel_update_btn = document.getElementById('cancel_update');
    cancel_update_btn.addEventListener('click', (e)=>{
        update_form.classList.add('d-none');
        insert_form.classList.remove('d-none');
    });

    let update_btns = document.getElementsByClassName('update_btn');
    for(let btn of update_btns){
        btn.addEventListener('click', (e)=>{
            update_form.classList.remove('d-none');
            insert_form.classList.add('d-none');

            // iau ce linie a fost selectata pe buton
            let selected_id = e.target.getAttribute('rowid');
            // setez in formul de update old id ca fiind cel de mai sus
            document.getElementById('old_id').value = selected_id;

            // iau linia din tabel
            let selected_row = document.querySelector(`tr[rowid='${selected_id}']`);

            // iau coloanele
            let selected_cols = Array.from(selected_row.querySelectorAll('td.table-value'));

            console.log(selected_cols);
            console.log(selected_cols.filter(elem => elem.getAttribute('colname') == 'id')[0].textContent);
            
            for(let input of update_form.querySelectorAll('textarea')){
                input.textContent = selected_cols.filter(elem => elem.getAttribute('colname') == input.name)[0].textContent;
                input.textContent = input.textContent.trim();
            }
        });
    }
}

