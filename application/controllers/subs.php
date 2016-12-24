<?php

require_once(ROOT_DIR . 'vendor/fpdf/pdf.php');


class Subs extends Controller 
{	
	function create_get()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

		$this->view('subreddit_create')->render();
	}

	function create_post()
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $v = $this->validator($this->post(), array(
			'title' => 'required|alphanumeric',
			'description' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{
			$this->view('subreddit_create')->set('errors', $v->errors)->message('error', 'Could not add subreddit')->render();
			return;
		}

	    $sub = $this->model('Subreddit');
	    $sub->title = $this->post('title');
	    $sub->description = $this->post('description');
	    $sub->subscribers = 0;
	    $sub->save();

        $this->redirect('/main/subreddits');
	}

	function edit_get($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $sub = $this->model('Subreddit')->getById($id);
		$this->view('subreddit_edit')->set('subreddit', $sub)->render();
	}   

	function edit_post($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $v = $this->validator($this->post(), array(
			'title' => 'required|alphanumeric',
			'description' => 'required|alphaplus'
			)
		);

		if(!$v->validate())
		{
			$this->view('subreddit_edit')->set('errors', $v->errors)->message('error', 'Could not edit subreddit')->render();
			return;
		}

	    $sub = $this->model('Subreddit')->getById($id);
	    $sub->title = $this->post('title');
	    $sub->description = $this->post('description');
	    $sub->save();

        $this->redirect('/main/subreddits');
	}     

	function delete_get($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $subreddit = $this->model('Subreddit')->getById($id);
	    $subreddit->delete();
        $this->redirect('/main/subreddits');
	}  

	function reportcsv_get()
	{
		$name = 'static/reports/csv/sub_report_' . date('dmY') . '.csv';
		$path = ROOT_DIR . $name;
		$subs = $this->model('Subreddit')->all();
		$fp = fopen($name, 'w');
		foreach($subs as $sub)
			fputcsv($fp, array($sub->id, $sub->title, $sub->description, $sub->subscribers));

		fclose($fp);

		$this->redirect($name);
	}

	function reportpdf_get()
	{
		$subs = $this->model('Subreddit')->all();
		$data = [];
		foreach($subs as $sub)
			$data[] = array($sub->id, $sub->title, $sub->subscribers);

		$pdf = new PDF();

		$header = array('ID', 'Subreddit title', 'Subscribers');
		$data = $pdf->LoadData($data);
		$pdf->SetFont('Arial', '', 14);
		$pdf->AddPage();
		$pdf->FancyTable($header, $data);
		$pdf->Output();
	}

}

?>
