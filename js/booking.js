window.onload = function(){

    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');
     
    let today = new Date();
    checkin.setAttribute('min', getDate(addDays(today,1)));

    if(checkin.getAttribute('value') == ''){ // if not completed from POST
        checkin.value = getDate(addDays(today,1));
    }

    if(checkout.getAttribute('value') == ''){ // if not completed from POST
        checkout.value = getDate(addDays(today,2));
    }

    checkin.addEventListener('change', function(){
        checkout.value = getDate(addDays(new Date(checkin.value),1));
    })
    
    checkout.addEventListener('click',function(e){
            this.setAttribute('min', getDate(addDays(new Date(checkin.value),1)));
    })


}

function addDays(date, days) {
    let result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
  }

function getDate(date){
    return date.getFullYear() + '-' + String(date.getMonth()+1).padStart(2,'0') + '-' + String(date.getDate()).padStart(2,'0');
}

function getDaysBetween(date1, date2)
{
    let d1 = new Date(date1);
    let d2 = new Date(date2);
    return (d2.getTime() - d1.getTime()) / (1000 * 3600 * 24);
}
 

