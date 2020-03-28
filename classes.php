<?php  

/**
 * summary
 */
class Animal
{
    /**
     animId name    img descr   type    website hobbies ad_date loca    locId   zip city    address loc_x   loc_y   
     */
    protected $animId;
    protected $name;
    protected $img;
    protected $descr;
    protected $website;
    protected $hobbies;
    protected $adDate;
    protected $zip;
    protected $city;
    protected $address;
    protected $loc_x;
    protected $loc_y;
    protected $type;


    public function __construct($animId,$name,$img,$descr,$website,$hobbies,$adDate,$zip,$city,$address,$loc_x,$loc_y,$type)
    {
        $this->animId = $animId;
        $this->name = $name;
        $this->img = $img;
        $this->descr = $descr;
        $this->website = $website;
        $this->hobbies = $hobbies;
        $this->adDate = $adDate;
        $this->zip = $zip;
        $this->city = $city;
        $this->address = $address;
        $this->loc_x = $loc_x;
        $this->loc_y = $loc_y;
        $this->type = $type;
    }
    public function getType(){return $this->type;}
    public function getId(){return $this->animId;}
    public function printCards()
    {
        if ($this->type == 'sm') {
            $extra = '<a class="" href="#">'.$this->website.'</a>';           
        } else if ($this->type == 'lg'){
            $extra = '<p class="card-text">Hobbies: '.$this->hobbies.'</p>';
        } else if ($this->type == 'sen') {
            $extra = '<p class="card-text">Looking for home since: '.$this->adDate.'</p>';
        }
        $addr = $this->zip.' '.$this->city.', '.$this->address;
        
        return '<div class="col-3 p-3">
	    			<div class="card">
		    			<img class="card-img-top img-fluid" src="'.$this->img.'" alt="Card image">
		    			<div class="card-body">
		    				<a href="index.php?itm='.$this->animId.'" class="stretched-link">
                                <h3 class="card-title">'.$this->name.'</h3>
                            </a>
                            '.$extra.'
		    				<p class="card-text">'.$addr.'</p>
		    			</div>
	    			</div>
    			</div>';
    }
    public function printDetails()
    {
    	if ($this->type == 'sm') {
            $extra = '<a class="" href="#">'.$this->website.'</a>';           
        } else if ($this->type == 'lg'){
            $extra = '<p class="card-text">Hobbies: '.$this->hobbies.'</p>';
        } else if ($this->type == 'sen') {
            $extra = '<p class="card-text">Looking for home since: '.$this->adDate.'</p>';
        }
        $addr = $this->zip.' '.$this->city.', '.$this->address;
        return '<div class="col-3 p-3">
					<img class="img-fluid" src="'.$this->img.'">
    			</div>
    			<div class="col-9 p-3">
    				<h4>'.$this->name.'</h4>
    				<h3>'.$extra.'</h3>
    				<p>'.$this->descr.'</p>
    				<p>'.$addr.'</p>
    			</div>';
    }
    public function printTable(){
        return '<tr><td>'.$this->name.'</td>
                <td>'.$this->website.'</td>
                <td>'.$this->hobbies.'</td>
                <td>'.$this->adDate.'</td>
                <td>'.$this->type.'</td>
                <td>
                    <div class="btn-group">
                        <a href="manager.php?edit=mdId'.$this->animId.'" class="btn btn-warning">Edit</a>
                        <a href="manager.php?delete='.$this->animId.'" class="btn btn-danger">Delete</a>
                    </div>
                </td></tr>';
    }
}
?>