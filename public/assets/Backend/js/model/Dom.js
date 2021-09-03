
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

