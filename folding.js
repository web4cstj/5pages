/*jslint browser:true, esnext:true*/
class Folding {
	static load() {
		if (location.search) {
			var elements = location.search.substr(1).split("&");
			elements.forEach(id => {
				var bouton = document.getElementById(id);
				if (bouton) {
					bouton.checked = true;
				}
				document.querySelector("table.cinqpages").classList.add(id);
			});
		}
		if (localStorage.toutafficher != "false") {
			document.getElementById("toutafficher").checked = localStorage.toutafficher;
		}
		this.ajouterColonnes();
		this.initToggle();
		this.initToggleColonne();
		document.getElementById("toutafficher").addEventListener('change', e=>{
			localStorage.toutafficher = e.currentTarget.checked;
		});
	}
	static ajouterColonnes(tr) {
		if (!tr) {
			document.querySelectorAll('tbody tr').forEach(tr=>{
				this.ajouterColonnes(tr);
			});
			return;
		}
		var tag = tr.classList.contains('entete') ? 'th' : 'td';
		['liste','details','ajout','modif','suppr',].forEach(c=>{
			var td = tr.appendChild(document.createElement(tag));
			td.classList.add(c);
		});
	}
	static initToggle() {
		var elements = document.querySelectorAll("tbody tr:not(.entete)");
		elements.forEach(element => element.addEventListener("click", this.evtToggle));
	}
	static initToggleColonne() {
		var elements = document.querySelectorAll("thead th[class]");
		elements.forEach(element => element.addEventListener("click", this.evtToggleColonne));
	}
	static evtToutAfficher(e) {
		e.currentTarget.classList.toggle("on");
	}
	static evtToggle(e) {
		e.currentTarget.classList.toggle("on");
	}
	static evtToggleColonne(e) {
		e.currentTarget.closest("table").classList.toggle(e.currentTarget.className);
	}
	static init() {
		window.addEventListener("load", () => this.load());
	}
}
Folding.init();
