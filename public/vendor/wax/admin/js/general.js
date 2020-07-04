	function randomString(length, type) {
		var chars;
		switch(type) {
			case 'password':
				chars = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ'.split('');
				break;

			case 'mixed_nocase':
				chars = '0123456789abcdefghiklmnopqrstuvwxyz'.split('');
				break;

			default:
				chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
				break;
		}

		var str = '';
		for (var i = 0; i < length; i++) {
			str += chars[Math.floor(Math.random() * chars.length)];
		}

		if(type == 'password') {
			var re = new RegExp("(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{" + length + ",}");
			if(!re.test(str)) {
				// this could be made more efficient by looping instead of
				// recursing, but it should generally only take an iteration or
				// two anyway.
				str = randomString(length, type);
			}
		}

		return str;
	}

	function urlencode (str) {
		return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A');
	}

	String.prototype.repeat = function(l){
		return new Array(l+1).join(this);
	}

	String.prototype.toURL = function() {
		var str = this.replace(/\s+/g, '-').match(/[a-zA-Z-.\d]/g);
		return (str == null) ? '' : str.join('');
	}


	function getObject(whichLayer) {
		if(document.getElementById)
			elem=document.getElementById(whichLayer);
		else if (document.all)
			elem=document.all[whichLayer];
		else if (document.layers)
			elem=document.layers[whichLayer];

		return elem;
	}

	function getSelectBoxValue(ob) {
		if(typeof(ob) != "object") ob = getObject(ob);
		return ob.options[ob.selectedIndex].value;
	}

	function setSelectBoxValue(ob, val) {
		var inpSel = document.getElementById(ob);
		for(i=0; i<inpSel.options.length; i++) {
			if(inpSel.options[i].value==val) inpSel.selectedIndex=i;
		}
	}

	function getRadioButtonValue(radioObj) {
		if(!radioObj)
			return "";
		var radioLength = radioObj.length;
		if(radioLength == undefined)
			if(radioObj.checked)
				return radioObj.value;
			else
				return "";
		for(var i = 0; i < radioLength; i++) {
			if(radioObj[i].checked) {
				return radioObj[i].value;
			}
		}
		return "";
	}

	function numbersonly(str) {
		var nums = str.match(/[0-9]+/g);
		if(nums == null) return "";
		str = "";
		for(i=0; i<nums.length; i++) {
			str = str + nums[i].toString();
		}
		return str;
	}

	String.prototype.numbersonly = function() {
		return numbersonly(this);
	}

	function isvalidemail(str) {
		var at="@";
		var dot=".";
		var lat=str.indexOf(at);
		var lstr=str.length;
		var ldot=str.indexOf(dot);
		var valid=true;

		if (str.indexOf(at)==-1) valid = false;
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr) valid = false;
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr) valid = false;
		if (str.indexOf(at,(lat+1))!=-1) valid = false;
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot) valid = false;
		if (str.indexOf(dot,(lat+2))==-1) valid = false;
		if (str.indexOf(" ")!=-1) valid = false;

		return valid;
	}

	String.prototype.isvalidemail = function() {
		return isvalidemail(this);
	}

	function checkAll(whichfield)
	{
		the_field=document.getElementsByName(whichfield);
		for (i = 0; i < the_field.length; i++) {

			the_field[i].checked = true ;

		}
	}

	function uncheckAll(whichfield)
	{
		the_field=document.getElementsByName(whichfield);
		for (i = 0; i < the_field.length; i++) {
			the_field[i].checked = false ;

		}
	}

	function check_url_safe(ob) {
		var doAlert = true;
		var val = ob.value;
		var reg = new RegExp("[^a-zA_Z0-9_./-]", "gi");

		if(arguments.length >= 2) doAlert = arguments[1];

		if(reg.test(val)) {
			if(doAlert) alert("Please use only alphanumeric characters or the following special characters:\n  _ (underscore)\n  - (dash)\n  . (period)\n  / (forward slash)");
			ob.value=ob.value.substring(0, ob.value.length-1);
			return false;
		} else {
			return true;
		}
	}


	function settimeinput(name, hours, minutes) {
		// Set values using 24-hour time
		if(arguments.length > 1) {
			var ampm = "am";
			if(hours > 11) {
				ampm = "pm";
				hours = hours - 12;
			}
			if(hours == 0) hours = 12;
			$(name + "_h").val(hours);
			$(name + "_m").val(minutes);
			$(name + "_a").val(ampm);
		}
		h = $(name + "_h").val();
		m = $(name + "_m").val();
		a = $(name + "_a").val();
		$(name).val(h + ":" + m + " " + a);
		$(name).trigger('change');
	}

	/**
	 * Function : dump()
	 * Arguments: The data - array,hash(associative array),object
	 *    The level - OPTIONAL
	 * Returns  : The textual representation of the array.
	 * This function was inspired by the print_r function of PHP.
	 * This will accept some data as the argument and return a
	 * text that will be a more readable version of the
	 * array/hash/object that is given.
	 * Docs: http://www.openjs.com/scripts/others/dump_function_php_print_r.php
	 */
	function dump(arr,level) {
		var dumped_text = "";
		if(!level) level = 0;

		//The padding given at the beginning of the line.
		var level_padding = "";
		for(var j=0;j<level+1;j++) level_padding += "    ";

		if(typeof(arr) == 'object') { //Array/Hashes/Objects
			for(var item in arr) {
				var value = arr[item];

				if(typeof(value) == 'object' && value != arr) { //If it is an array,
					dumped_text += level_padding + "'" + item + "' ...\n";
					dumped_text += dump(value,level+1);
				} else {
					dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
				}
			}
		} else { //Stings/Chars/Numbers etc.
			dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
		}
		return dumped_text;
	}


	function cloneObject(ob) {
	  var newObj = (ob instanceof Array) ? [] : {};
	  for (i in ob) {
		if (i == 'clone') continue;
		if (ob[i] && typeof ob[i] == "object") {
		  newObj[i] = cloneObject(ob[i]);
		} else newObj[i] = ob[i]
	  } return newObj;
	};

