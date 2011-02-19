<!-- antispam script from http://snippets.dzone.com/posts/show/699 - thanks! -->
	if (!document.getElementsByTagName && !document.createElement &&
		!document.createTextNode) exit;
	var nodes = document.getElementsByTagName("span");
	for(var i=nodes.length-1;i>=0;i--) {
		if (nodes[i].className=="email") {
			var at = / at /;
			var dot = / dot /g;
			var node = document.createElement("a");
			var address = nodes[i].firstChild.nodeValue;

			address = address.replace(at, "@");
			address = address.replace(dot, ".");

			address = address.replace(at, "@");
			address = address.replace(dot, ".");
			node.setAttribute("href", "mailto:"+address);
			node.appendChild(document.createTextNode(address));
			
			var prnt = nodes[i].parentNode;
			for(var j=0;j<prnt.childNodes.length;j++)
				if (prnt.childNodes[j] == nodes[i]) {
					if (!prnt.replaceChild) exit;
					prnt.replaceChild(node, prnt.childNodes[j]);
					break;
				}
		}
	}
