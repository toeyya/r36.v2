<?php
class Dashboards extends Public_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ga');
	}
	
	function index()
	{
		$ga = new ga();
		$ga->authen('favouritedesign@gmail.com','F@vourite','ga:75710162');
		$now=date("Y-m-d");
		$lastmonth=date('Y-m-d', strtotime('-10 days'));

		//Summery: visitors, unique visit, pageview, time on site, new visits, bounce rates
		$data['summery']=$ga->getSummery($lastmonth,$now);
		
		//All time summery: visitors, page views
		$data['allTimeSummery']=$ga->getAllTimeSummery();
		
		//Last 10 days visitors (for graph)
		$data['visits']=$ga->getVisits($lastmonth,$now,10);
		// Today
		$data['summary_today']=$ga->getVisits($now,$now,10);
		//Top 10 search engine keywords
		$data['topKeywords']=$ga->getTopKeyword($lastmonth,$now,10);
		
		//Top 10 visitor countries
		$data['topCountries']=$ga->getTopCountry($lastmonth,$now,10);
		
		//Top 10 page views
		$data['topPages']=$ga->getTopPage($lastmonth,$now,10);
		
		//Top 10 referrer websites
		$data['topReferrer']=$ga->getTopReferrer($lastmonth,$now,10);
		
		//Top 10 visitor browsers
		$data['topBrowsers']=$ga->getTopBrowser($lastmonth,$now,10);
		
		//Top 10 visitor operating systems
		$data['topOs']=$ga->getTopOs($lastmonth,$now,10);
		$this->template->build("index",$data);
	}	
	function inc_home()
	{
		$ga = new ga();
		$ga->authen('favouritedesign@gmail.com','F@vourite','ga:75710162');
		$now=date("Y-m-d");
		$start_month=date('Y-m-01');
		$end_month= date("Y-m-t", strtotime($start_month));
		$data['allTimeSummery']=$ga->getAllTimeSummery();
		$data['summary_today']= $ga->getVisits($now,$now,10);
		$data['summary_month']= $ga->getVisits($start_month,$end_month,10);
		
		$this->load->view("inc_home",$data);
	}
	
}
?>