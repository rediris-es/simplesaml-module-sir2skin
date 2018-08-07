(function (window, document) {

    var layout   = document.getElementById('layout'),
        content  = document.getElementById('content'),
    	footer  = document.getElementById('foot');

    function toggleClass(element, className) {
        var classes = element.className.split(/\s+/),
            length = classes.length,
            i = 0;

        for(; i < length; i++) {
            if (classes[i] === className) {
                classes.splice(i, 1);
                break;
            }
        }
        // The className is not found
        if (length === classes.length) {
            classes.push(className);
        }

        element.className = classes.join(' ');
    }

    function resetToggle(e){

    	e.preventDefault();

    	var activeElement = null;

    	for (var i = 0; i < elements.length; i++) {
		    var element = elements[i];
		    if (element.classList.contains('active')) {
		    	element.classList.remove('active');
		    	document.getElementById(element.dataset.target).classList.remove('active');
				activeElement = element;
			}
		}

		if (layout.classList.contains('active')) {
			layout.classList.remove('active');
		}

		if (content.classList.contains('active')) {
			content.classList.remove('active');
		}

		if (footer.classList.contains('active')) {
			footer.classList.remove('active');
		}

		return activeElement;

    }

    function toggleAll(e) {

    	var activeElement = resetToggle(e);
    	if(activeElement!==this){
    		var active = 'active';
	        e.preventDefault();
	        toggleClass(layout, active);
	        toggleClass(document.getElementById(this.dataset.target), active);
	        toggleClass(this, active);
	        toggleClass(footer, active);
    	}
        
    }


    var elements = document.getElementsByClassName("menu-link");

	for (var i = 0; i < elements.length; i++) {
	    elements[i].addEventListener('click', toggleAll, false);
	}


    content.onclick = function(e) {

    	var isActiveElement = false;

    	for (var i = 0; i < elements.length; i++) {
		    var element = elements[i];
		    if (element.classList.contains('active')) {
		    	element.classList.remove('active');
		    	document.getElementById(element.dataset.target).classList.remove('active');
				isActiveElement = true;
			}
		}

        console.log(e.target.nodeName);

		if(isActiveElement==true && e.target.nodeName!="A" && e.target.nodeName!="BUTTON" && e.target.nodeName!="INPUT"){
			
        	resetToggle(e);
		}
    };

}(this, this.document));
