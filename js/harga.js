function kurensi(nilai) 
{
		bk = nilai.replace(/[^\d]/g,"");
		ck = "";
		panjangk = bk.length;
		j = 0;
		for (i = panjangk; i > 0; i--) 
		{
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)) 
			{
				ck = bk.substr(i-1,1) + "." + ck;
				xk = bk;
			} 
			else 
			{
				ck = bk.substr(i-1,1) + ck;
				xk = bk;
			}
		}
		return ck;
}

function ri() 
{
	ttm = document.getElementById( 'postform' ).elements['salePrice'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'postform' ).elements['salePrice'].value = kttm;
}
