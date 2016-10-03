<?php
namespace App\controllers ;
use App\controllers\Controller;
use Models\Berita as ModelsBerita; //karena lupa nama class nya sama dengan nama controller nya jdi di as (alias biar ga bentrok|class re declare)
Class Berita extends Controller {
	public function index()
	{
		$steve_jobs_quotes = array(
			array('judul' => 'Technology is nothing.',
				'text'=>'Technology is nothing. Whats important is that you have a faith in people, that they re basically good and smart, and if you give them tools, they ll do wonderful things with them '),
			array('judul' => 'Design is a funny word.',
				'text'=>'Design is a funny word. Some people think design means how it looks. But of course, if you dig deeper, it s really how it works, Everyone here has the sense that right now is one of those moments when we are influencing the future.'),
			array('judul'=>'Your time is limited','text'=>'Your time is limited, so dont waste it living someone else s life. Dont be trapped by dogma - which is living with the results of other peoples thinking. Dont let the noise of others opinions drown out your own inner voice. And most important, have the courage to follow your heart and intuition')
		);
		$berita = ModelsBerita::limit(9)->get();				
		echo $this->render_template('home.twig', array('berita' => $berita, 'quotes' => $steve_jobs_quotes));
	}
	public function BacaBerita($slug)
	{		
		$getBerita = ModelsBerita::where('slug', '=', $slug)->first();				
		if(count($getBerita) < 1){			
			header("HTTP/1.0 404 Not Found");	
			exit('Halaman Tidak ditemukan') ;
		}		
		echo $this->render_template('baca_berita.twig', 
			array('get_berita' =>$getBerita)
		);		
		//echo json_encode($getBerita);
	}
}
