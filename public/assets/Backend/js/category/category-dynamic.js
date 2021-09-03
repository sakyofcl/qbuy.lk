import {Class} from '../model/Dom.js';
$(document).ready((e)=>{

    Class.addEvent('cat-edit-btn','click',(e)=>{

        //get target element
        let target=$(e.target).attr('target');
        let targetEle=document.getElementById(target);

        let display=$(e.target).attr('display');
        let displayEle=document.getElementById(display);
        
        let defaultEditContainer=document.getElementById( $(e.target).attr('container') );
        let categoryEditContainer=document.getElementById( $(e.target).attr('targetContainer'));

        Class.addClass(['d-flex'],targetEle);
        
        //remove display category
        Class.removeClass(['d-flex'],displayEle);
        Class.addClass(['d-none'],displayEle);

        //remove default category container
        Class.removeClass(['d-block'],defaultEditContainer);
        Class.addClass(['d-none'],defaultEditContainer);
        //add category edit container
        Class.removeClass(['d-none'],categoryEditContainer);
        Class.addClass(['d-block'],categoryEditContainer);
    })

    Class.addEvent('cancel-cat-btn','click',(e)=>{

        //get target element
        let target=document.getElementById( $(e.target).attr('target'));
        let display=document.getElementById( $(e.target).attr('display'));
    
        let defaultEditContainer=document.getElementById( $(e.target).attr('targetContainer') );
        let categoryEditContainer=document.getElementById( $(e.target).attr('container'));

        //remove category edit form
        Class.removeClass(['d-flex'],target);
        Class.addClass(['d-none'],target);

        //show default catgory display
        Class.removeClass(['d-none'],display);
        Class.addClass(['d-flex'],display);

    
        //remove default category container
        Class.removeClass(['d-none'],defaultEditContainer);
        Class.addClass(['d-block'],defaultEditContainer);
        //add category edit container
        Class.removeClass(['d-block'],categoryEditContainer);
        Class.addClass(['d-none'],categoryEditContainer);
    })
    
})