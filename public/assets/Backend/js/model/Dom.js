
/*
this class will work pure javascript
*/
export class Class{
    static addEvent(c,e,m) {
        let classElement=document.getElementsByClassName(c);
        for (let i = 0; i < classElement.length; i++) {
            classElement[i].addEventListener(e,m);
        }
    }

    static removeClass(c,e){
        let remove=e;
        c.map((v)=>{
            remove.classList.remove(v);
        })
    }

    static addClass(c,e){
        let add=e;
        c.map((v)=>{
            add.classList.add(v);
        })
    }
}

export class DateExtract{
    humanReadbleDate(timestamp,format='d-m-y'){
        const dmy=/(d)-(m)-(y)/g;
        const dMy=/(d)-(M)-(y)/g;
        const dMytime=/(h):(m)/g;
        const date = new Date(timestamp)
        
        const monthsLong=["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
      

        const datevalues = {
            year:date.getFullYear(),
            month:date.getMonth(),
            day:date.getDate(),
            hour:date.getHours(),
            minit:date.getMinutes(),
        }

        //preset values
        const sm=date.toLocaleString('default',{ month: 'short' });
        const lm=date.toLocaleString('default',{ month: 'long' });
        const y=datevalues.year;
        const d=datevalues.day;
        const m=datevalues.month;
        const hm=date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        const minit=datevalues.minit;

        if(dmy.test(format)){
            return d+"-"+m+"-"+y;
        }
        else if(dMy.test(format)){
            return d+"-"+sm+"-"+y;
        }
        else if(dMytime.test(format)){
            return d+"-"+sm+"-"+y+" "+hm;
        }
        
        return datevalues;
    }
}


export class NumberExtract{
    static numberWithComma(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
}
