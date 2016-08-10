
<?php
	require_once ('../inc/dbinfo.inc');

	class phpork_functions

	{
		public function connect() {
			$link = mysqli_connect ( HOSTNAME, USERNAME, PASSWORD, DATABASE ) or die ( 'Could not connect: ' . mysqli_error () );
			mysqli_select_db ( $link, DATABASE ) or die ( 'Could not select database' . mysql_error () );
			return $link;
		}
	 	public function login($username,$password){
		    $link = $this->connect();
		    $login = mysqli_real_escape_string($link,$username);
		    $pword = mysqli_real_escape_string($link,$password);
		    $query = "SELECT user_id,user_name FROM user WHERE user_name = '$login' AND password = '".$pword."' LIMIT 1";
		    $result = mysqli_query ( $link, $query );
		    if(mysqli_num_rows($result) == 1){
		      while ( $row = mysqli_fetch_row ( $result ) ) {
		        $lid = $row[0];

		        session_start();
		        session_regenerate_id(TRUE);
		        $_SESSION['userid'] = $row[0];
		        $_SESSION['uname'] = $row[1];
		      }
		     
		      return true;
		    }else{
		      return false;
		    }
	  	}
	  	public function signup($username,$password,$usertype,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(user_id)
					FROM user";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO user(user_id,user_name,password,user_type) 
						VALUES('" . $max . "','" . $username . "','" . $password . "','" . $usertype . "');";
				if ($result = mysqli_query( $link, $query )) {
		      		$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      		$this->userTransactionEdit($user,$max,"user",0,$username,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function getUser($user_id)
		{
				$link = $this->connect();
				$query = "SELECT user_id,
							user_name, 
							user_type,
							password 
						FROM user
						WHERE user_id = '" .$user_id. "'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$userDetails = array();
				$arr_user = array();
				while ($row = mysqli_fetch_row($result)) {
						$userDetails['user_id'] = $row[0];
						$userDetails['user_name'] = $row[1];
						$userDetails['user_type'] = $row[2];
						$userDetails['password'] = $row[3];
						$arr_user[] = $userDetails;
				}

				return $arr_user;
		}

		public function updateUser($username,$password,$usertype, $user_id)
		{
				$link = $this->connect();
				$query = "UPDATE user 
							set user_name = '" .$username. "', 
								password = '" . $password . "', 
								user_type = '" . $usertype . "'
						WHERE user_id = '" . $user_id. "'";
				$result = mysqli_query($link, $query);
		}

		public function userTransactionEdit($user,$edit_id, $edit_type, $prev_val, $curr_val, $flag,$pig)
		{
				$link = $this->connect();
				
				$query = "INSERT INTO user_transaction(user_id,id_edited,type_edited,prev_value,curr_value,pig_id,flag) 
							values('" . $user . "','" . $edit_id . "','" . $edit_type . "','" . $prev_val . "','" . $curr_val . "','". $pig . "','". $flag . "');";
				$result = mysqli_query($link, $query);
				
			    
			   
		}
		public function ddl_user()
	    {
	        $link     = $this->connect();
	        $search   = "SELECT user_id,user_name,user_type,password FROM user";
	        $resultq  = mysqli_query($link, $search);
	        $usr    = array();
	        $usrArr = array();
	        while ($row = mysqli_fetch_row($resultq)) {
	            $usr['user_id']   = $row[0];
	            $usr['username'] = $row[1];
	            $usr['user_type']   = $row[2];
	            $usr['password'] = $row[3];
	            $usrArr[]      = $usr;
	        }
	        return $usrArr;
	    }
		public function searchUser($user_name)
		{
				$link = $this->connect();
				$query = "SELECT user_id,
							user_name, 
							user_type,
							password 
						FROM user
						WHERE user_name LIKE '%" .$user_name. "%'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$userDetails = array();
				$arr_user = array();
				while ($row = mysqli_fetch_row($result)) {
						$userDetails['user_id'] = $row[0];
						$userDetails['user_name'] = $row[1];
						$userDetails['user_type'] = $row[2];
						$userDetails['password'] = $row[3];
						$arr_user[] = $userDetails;
				}

				return $arr_user;
		}

	  	/* Location functions*/
	  	public function addLocationName($lname,$addr,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(loc_id)
					FROM location";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO location(loc_id,loc_name,address) 
						VALUES('" . $max . "','" . $lname . "','" . $addr . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      	$this->userTransactionEdit($user,$max,"location",0,$lname,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
	  	public function ddl_location()
		{
				$link = $this->connect();
				$query = "SELECT loc_name, 
							loc_id,
							address 
						FROM location";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$loc = array();
				$arr_loc = array();
				while ($row = mysqli_fetch_row($result)) {
						$loc['loc_name'] = $row[0];
						$loc['loc_id'] = $row[1];
						$loc['address'] = $row[2];
						$arr_loc[] = $loc;
				}

				return $arr_loc;
		}
		public function getLocDetails($loc_id)
		{
				$link = $this->connect();
				$query = "SELECT l.loc_name, 
							l.loc_id,
							l.address
						FROM location l 
						where l.loc_id = '".$loc_id."'
						LIMIT 1";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$loc = array();
				$arr_loc = array();
				while ($row = mysqli_fetch_row($result)) {
						$loc['loc_name'] = $row[0];
						$loc['loc_id'] = $row[1];
						$loc['address'] = $row[2];
						$arr_loc[] = $loc;
				}

				return $arr_loc;
		}
		public function searchLoc($loc_name)
		{
				$link = $this->connect();
				$query = "SELECT l.loc_name, 
							l.loc_id,
							l.address
						FROM location l 
						where l.loc_name LIKE '%".$loc_name."%'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$loc = array();
				$arr_loc = array();
				while ($row = mysqli_fetch_row($result)) {
						$loc['loc_name'] = $row[0];
						$loc['loc_id'] = $row[1];
						$loc['addr'] = $row[2];
						$arr_loc[] = $loc;
				}

				return $arr_loc;
		}

		public function getHousePenByLoc($loc)
		{
				$link = $this->connect();
				$search = "SELECT a.pen_id, 
								a.pen_no, 
								b.house_no,
								b.house_id 
							FROM pen a 
								INNER JOIN house b 
									ON a.house_id = b.house_id 
								INNER JOIN location l 
									ON l.loc_id = b.loc_id 
							WHERE l.loc_id = '" . $loc . "'";
				$resultq = mysqli_query($link, $search);
				$houpen = array();
				$hp_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {
						$houpen['pen_id'] = $row[0];
						$houpen['pen_no'] = $row[1];
						$houpen['house_no'] = $row[2];
						$houpen['house_id'] = $row[3];
						$hp_arr[] = $houpen;
				}

				return $hp_arr;
		}

		public function updateLocation($loc_id, $loc_name, $addr)
		{
				$link = $this->connect();
				$query = "UPDATE location 
							set loc_name = '" .$loc_name. "',
								address = '" .$addr. "'
						WHERE loc_id = '" . $loc_id. "'";
				$result = mysqli_query($link, $query);

		}



		/* end of location functions*/

		/*    HOUSE FUNCTIONS  */
		public function addHouseName($hno, $hname,$fxn,$loc,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(house_id)
					FROM house";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO house(house_id,house_no,house_name,function,loc_id) 
						VALUES('" . $max . "','" . $hno . "','" . $hname . "','" . $fxn . "','" . $loc . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      		$this->userTransactionEdit($user,$max,"house",0,$hname,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function ddl_house()
		{
			
				$link = $this->connect();
				$hquery = "SELECT house_id, 
								house_no, 
								house_name,
								function,
								loc_id
							FROM house";
				$hresult = mysqli_query($link, $hquery);
				$house = array();
				$arr_house = array();
				while ($row = mysqli_fetch_row($hresult)) {
						$house['h_id'] = $row[0];
						$house['h_no'] = $row[1];
						$house['h_name'] = $row[2];
						$house['fxn'] = $row[3];
						$house['loc_id'] = $row[4];
						$arr_house[] = $house;
				}

				return $arr_house;
		}
		public function getHouseByLoc($loc){
			$link = $this->connect();
			$hquery = "SELECT house_id, 
							house_no, 
							house_name,
							function,
							loc_id
						FROM house 
						WHERE loc_id = '" . $loc . "'
						ORDER BY house_no ASC";
			$hresult = mysqli_query($link, $hquery);
			$house = array();
			$arr_house = array();
			while ($row = mysqli_fetch_row($hresult)) {
					$house['h_id'] = $row[0];
					$house['h_no'] = $row[1];
					$house['h_name'] = $row[2];
					$house['fxn'] = $row[3];
					$house['loc_id'] = $row[4];
					$arr_house[] = $house;
			}

			return $arr_house;
		
			
		}
		public function getHouseDetails($h_id){
			$link = $this->connect();
			$hquery = "SELECT house_id, 
							house_no, 
							house_name,
							function,
							loc_id
						FROM house 
						WHERE house_id = '" . $h_id . "'";
			$hresult = mysqli_query($link, $hquery);
			$house = array();
			$arr_house = array();
			while ($row = mysqli_fetch_row($hresult)) {
					$house['h_id'] = $row[0];
					$house['h_no'] = $row[1];
					$house['h_name'] = $row[2];
					$house['fxn'] = $row[3];
					$house['loc_id'] = $row[4];
					$arr_house[] = $house;
			}

			return $arr_house;
		
			
		}

		public function updateHouse($houseid, $houseno, $housename, $location, $fxn)
		{
				$link = $this->connect();
				$query = "UPDATE house 
							set house_name = '" .$housename. "',
								house_no = '" .$houseno. "',
								loc_id = '" .$location. "',
								function = '" .$fxn. "',
						WHERE house_id = '" . $houseid. "'";
				$result = mysqli_query($link, $query);
		}
		/*END OF HOUSE FUNCTIONS*/

		/*   PEN FUNCTIONS   */
		public function addPenName($penno,$fxn,$h_id,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(pen_id)
					FROM pen";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO pen(pen_id,pen_no,function,house_id) 
						VALUES('" . $max . "','" . $penno . "','" . $fxn . "','" . $h_id . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      		 $this->userTransactionEdit($user,$max,"pen",0,$penno,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function ddl_pen()
		{
				$link = $this->connect();
				$pquery = "SELECT pen_id, 
							pen_no,
							function,
							house_id 
						FROM pen";
				$presult = mysqli_query($link, $pquery);
				$pen = array();
				$arr_pen = array();
				while ($row = mysqli_fetch_row($presult)) {
						$pen['pen_no'] = $row[1];
						$pen['pen_id'] = $row[0];
						$pen['fxn'] = $row[2];
						$pen['h_id'] = $row[3];
						$arr_pen[] = $pen;
				}

				return $arr_pen;
		}
		public function ddl_notMortalityPen($house)
		{
				$link = $this->connect();
				$pquery = "SELECT pen_id, 
							pen_no,
							function,
							house_id 
						FROM pen 
						WHERE house_id = '" . $house . "' and 
						function != 'mortality'
						ORDER BY pen_no ASC";
				$presult = mysqli_query($link, $pquery);
				$pen = array();
				$arr_pen = array();
				while ($row = mysqli_fetch_row($presult)) {
						$pen['pen_id'] = $row[0];
						$pen['pen_no'] = $row[1];
						$pen['fxn'] = $row[2];
						$pen['h_id'] = $row[3];
						$arr_pen[] = $pen;
				}

				return $arr_pen;
		}
		public function getPenByHouse($house)
		{
				$link = $this->connect();
				$pquery = "SELECT pen_id, 
							pen_no,
							function,
							house_id
						FROM pen 
						WHERE house_id = '" . $house . "'";
				$presult = mysqli_query($link, $pquery);
				$pen = array();
				$arr_pen = array();
				while ($row = mysqli_fetch_row($presult)) {
						$pen['pen_no'] = $row[1];
						$pen['pen_id'] = $row[0];
						$pen['fxn'] = $row[2];
						$pen['h_id'] = $row[3];
						$arr_pen[] = $pen;
				}

				return $arr_pen;
		}
		public function getPenDetails($pen_id)
		{
				$link = $this->connect();
				$pquery = "SELECT p.pen_id, 
							p.pen_no,
							p.function,
							p.house_id,
							h.loc_id
						FROM pen p
						INNER JOIN house h on p.house_id = h.house_id 
						WHERE p.pen_id = '" . $pen_id . "'";
				$presult = mysqli_query($link, $pquery);
				$pen = array();
				$arr_pen = array();
				while ($row = mysqli_fetch_row($presult)) {
						$pen['pen_no'] = $row[1];
						$pen['pen_id'] = $row[0];
						$pen['fxn'] = $row[2];
						$pen['h_id'] = $row[3];
						$pen['loc_id'] = $row[4];
						$arr_pen[] = $pen;
				}

				return $arr_pen;
		}

		public function updatePen($penid, $penno, $fxn)
		{
				$link = $this->connect();
				$query = "UPDATE pen 
							set pen_no = '" .$penno. "',
								function = '" .$fxn. "'
						WHERE pen_id = '" . $penid. "'";
				$result = mysqli_query($link, $query);
		}
		/* END OF pen.php FUNCTIONS*/

		/* pig.php functions */
		
		

	  	public function addPig($pid, $pbdate, $pweekfar, $ppen, $pgender, $pbreed, $pboar, $psow, $pfoster,$pstatus, $user)
		{
			$handler = "";
			$valHandler = "";
			$link = $this->connect();
			if ($pboar != "null") {
					$handler = "boar_id,";
					$valHandler = "'" . $pboar . "',";
			}

			if ($psow != "null") {
					$handler = $handler . "sow_id,";
					$valHandler = $valHandler . "'" . $psow . "',";
			}

			if ($pfoster != "null") {
					$handler = $handler . "foster_sow,";
					$valHandler = $valHandler . "'" . $pfoster . "',";
			}

			

			$query=sprintf("INSERT INTO pig(pig_id," . $handler . "week_farrowed,gender,farrowing_date,pig_status,pen_id,breed_id,user,pig_batch) 
                    VALUES('" . mysqli_escape_string($link,$pid) . "'," . $valHandler . "'" . mysqli_escape_string($link,$pweekfar) . "','" . mysqli_escape_string($link,$pgender) . "','" . mysqli_escape_string($link,$pbdate) . "','" . mysqli_escape_string($link,$pstatus) . "','" . mysqli_escape_string($link,$ppen) . "','" . mysqli_escape_string($link,$pbreed) . "','" . mysqli_escape_string($link,$user) . "','-')");
		    if ($result = mysqli_query( $link, $query )) {
		      $data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		    }else {
		      $data = array("success"=>"false",
		                      "error"=>mysqli_error($link));
		    }
		    $this->userTransactionEdit($user,0,"new pig",0,0,1,$pid);
		    return $data;
		}

		public function addPigWeight($pid, $pweight, $remarks)
		{
			$link = $this->connect();
			date_default_timezone_set("Asia/Manila");
			$d = date("Y-m-d");
			$t = date("h:i:s");
			$query = "INSERT INTO  weight_record(record_date,record_time,weight,pig_id,remarks) 
					VALUES ('" . $d . "','" . $t . "','" . $pweight . "','" . $pid . "','" . $remarks . "')";
			$this->userTransactionEdit($user,0,"weight",0,$pweight,1,$pid);
			$result = mysqli_query($link, $query);
		}
		  public function getPigDetails($pigid){
		    $link = $this->connect();
		    $query = "SELECT  p.pig_id,
			    			  pa.label_id,
			    			  par.label_id,
		                      p.foster_sow,
		                      p.week_farrowed,
		                      p.gender,
		                      p.farrowing_date,
		                      p.pig_status,
		                      p.pen_id,
		                      p.breed_id,
		                      p.user,
		                      p.pig_batch,
		                      h.house_id,
		                      l.loc_name,
		                      h.house_no,
		                      p.pen_id,
		                      pb.breed_name,
		                      rfid.tag_rfid,
		                      l.loc_id,
		                      rfid.label,
		                      rfid.tag_id
		              FROM pig p
		              INNER JOIN pen pe ON 
		              p.pen_id = pe.pen_id
		              INNER JOIN house h ON
		              pe.house_id = h.house_id
		              INNER join location l ON
		              h.loc_id = l.loc_id
		              INNER JOIN pig_breeds pb ON
		              p.breed_id = pb.breed_id
		              INNER JOIN rfid_tags rfid ON
		              rfid.pig_id = p.pig_id
		              INNER JOIN parents pa ON
		              (pa.parent_id = p.boar_id AND pa.label =\"boar\")
		             	 INNER JOIN parents par ON
		             	 (par.parent_id = p.sow_id AND par.label=\"sow\")
		             AND p.pig_id = '".$pigid."'
		              LIMIT 1";
		              
		    $result = mysqli_query($link, $query);
		   	$pig = array();
			$pig_arr = array();
			//$aa = $this->getPigWeightDetails($pig_id);
			while ($row = mysqli_fetch_row($result))
		    {
		        $pig['pid'] = $row[0];
		        $pig['boar'] = $row[1];
		        $pig['sow'] = $row[2];
		        $pig['foster'] = $row[3];
		        $pig['week_far'] = $row[4];
		        $pig['gender'] = $row[5];
		        $pig['far_date'] = $row[6];
		        $pig['pig_stat'] = $row[7];
		        $pig['pen_id'] = $row[8];
		        $pig['breed_id'] = $row[9];
		        $pig['user'] = $row[10];
		        $pig['batch'] = $row[11];
		        $pig['h_id'] = $row[12];
		        $pig['loc_name'] = $row[13];
		        $pig['h_name'] = $row[14];
		        $pig['p_name'] = $row[15];
		        $pig['br_name'] = $row[16];
		        $pig['rfid_tag'] = $row[17];
		        $pig['loc_id'] = $row[18];
		        $pig['label'] = $row[19];
		        $pig['tag_id'] = $row[20];
		        $pig_arr[] = $pig;
		     }
		   
		   $fp = fopen(getenv("HOMEDRIVE") . getenv("HOMEPATH").'\\Desktop\\reports\\pig_details\\pig_details.json', 'w');
			fwrite($fp, json_encode($pig_arr));
			fclose($fp);
		    return $pig_arr;
		  }
	  	public function getPigLabel($pigid)
	    {
	        $link   = $this->connect();
	        $query  = "SELECT label,
	        				tag_id,
	        				tag_rfid,
	        				pig_id,
	        				status 
        				FROM rfid_tags 
        				WHERE pig_id = '" . $pigid . "'";
	        $result = mysqli_query($link, $query);
	        $result = mysqli_query ( $link, $query );
		   	$pig = array();
			$pig_arr = array();
			while ($row = mysqli_fetch_row($result))
		    {
		        $pig['label'] = $row[0];
		        $pig['t_id'] = $row[1];
		        $pig['t_rfid'] = $row[2];
		        $pig['pig'] = $row[3];
		        $pig['stat'] = $row[4];
		        
		        $pig_arr[] = $pig;

		    }
		    return $pig_arr;
	    }
	    public function getinsertRFID($pigid)
		{
		    $link   = $this->connect();
		    $query  = "SELECT tag_rfid,
		                tag_id 
		                FROM rfid_tags 
		                WHERE label = '" . $pigid . "' and status='inactive'
		                LIMIT 1";
		    $result = mysqli_query($link, $query);
		    $row    = mysqli_fetch_row($result);
		    $r      = array();
		    $arr    = array();
		    $r['t_rfid']    = $row[0];
		    $r['t_id']    = $row[1];
		    $arr[] =$r;
		    return $arr;
		}
	  	public function getPigWeightDetails($pigid){
	     	$link    = $this->connect();
	        $query   = "SELECT max(record_date)
	                    FROM weight_record 
	                    WHERE pig_id = '" . $pigid . "' LIMIT 1";
	        $result  = mysqli_query($link, $query);
	        $row     = mysqli_fetch_row($result);
	        $query3   = "SELECT max(record_time)
	                    FROM weight_record 
	                    WHERE pig_id = '" . $pigid . "' and
	                    record_date = '".$row[0]."' LIMIT 1";
	        $result3  = mysqli_query($link, $query3);
	        $row3     = mysqli_fetch_row($result3);
	        $query2  = "SELECT weight,
	        				record_date,
	        				record_time,
	                        record_id,
	                        remarks 
	                    FROM weight_record 
	                    WHERE pig_id = '" . $pigid . "'
	                    AND record_date = '" . $row[0] . "' 
	                    and record_time = '" . $row3[0] . "' 
	                    LIMIT 1";
	        $result2 = mysqli_query($link, $query2);
	       	$data = array();
	       	$data2 = array();
	   	 	while($row2 =mysqli_fetch_row($result2))
		    {
		        $data['weight'] = $row2[0];
		        $data['record_date'] = $row2[1];
		        $data['record_time'] = $row2[2];
		        $data['record_id'] = $row2[3];
		        $data['remarks'] = $row2[4];
		        $data2[] = $data;
		    }
		   	
		    return $data2;
	  	}
	 	public function getPigFeedsDetails($pigid){
		    $link = $this->connect();
		    $query = "SELECT ft.ft_id,
		    				ft.quantity,
		    				ft.unit,
		    				ft.date_given,
		    				ft.time_given,
		    				ft.feed_id,
		    				ft.prod_date,
		    				f.feed_name,
		    				f.feed_type
		              FROM feeds f
		              inner join feed_transaction ft 
		              	on f.feed_id = ft.feed_id
		              where ft.pig_id = '".$pigid."' LIMIT 1";
		              
	    	$result = mysqli_query ( $link, $query );
		   	$fname = array();
			$feeds = array();
			while ($row = mysqli_fetch_row($result)) {
					$fname['ft_id'] = $row[0];
					$fname['qty'] = $row[1];
					$fname['unit'] = $row[2];
					$fname['date'] = $row[3];
					$fname['time'] = $row[4];
					$fname['fid'] = $row[5];
					$fname['proddate'] = $row[6];
					$fname['fname'] = $row[7];
					$fname['ftype'] = $row[8];
					$feeds[] = $fname;
			}
			
			
			return $feeds;
	  	}
	   	public function getPigMedsDetails($pigid){
		    $link = $this->connect();
		    $query = "SELECT mr.mr_id,
		    				mr.quantity,
		    				mr.unit,
		    				mr.date_given,
		    				mr.time_given,
		    				mr.med_id,
		    				m.med_name,
		    				m.med_type
		              FROM medication m
		              inner join med_record mr
		              	on m.med_id = mr.med_id
		              where mr.pig_id = '".$pigid."'
		              LIMIT 1";
		              
		    $result = mysqli_query ( $link, $query );
		   	$mname = array();
			$meds = array();
			while ($row = mysqli_fetch_row($result)) {
					$mname['mr_id'] = $row[0];
					$mname['qty'] = $row[1];
					$mname['unit'] = $row[2];
					$mname['date'] = $row[3];
					$mname['time'] = $row[4];
					$mname['mid'] = $row[5];
					$mname['mname'] = $row[6];
					$mname['mtype'] = $row[7];
					$meds[] = $mname;
			}
			
			return $meds;
	  	}
	  	 public function getCurrentHouse($pigid)
	    {
	        $link   = $this->connect();
	        $query  = "SELECT h.house_no, p.pen_no 
	                    FROM pig pi 
	                        INNER JOIN pen p 
	                            ON p.pen_id = pi.pen_id 
	                        INNER JOIN house h 
	                            ON h.house_id = p.house_id 
	                        WHERE pi.pig_id = '" . $pigid . "'";
	        $result = mysqli_query($link, $query);
	      	$pig = array();
			$arr_pig = array();
			while ($row = mysqli_fetch_row($result)) {
						$pig['house'] = $row[0];
						$pig['pen'] = $row[1];
						$arr_pig[] = $pig;
				}

				return $arr_pig;
	    }
	  	public function getLastFeed($pigid)
	    {
	        $link   = $this->connect();
	        $query  = "SELECT f.feed_name, 
	                        f.feed_type, 
	                        ft.date_given
	                    FROM feeds f 
	                        INNER JOIN feed_transaction ft 
	                            ON ft.feed_id = f.feed_id 
	                   WHERE ft.time_given = (SELECT max(ft.time_given) from feed_transaction ft INNER JOIN feeds f ON f.feed_id = ft.feed_id WHERE ft.date_given = (SELECT max(ft.date_given) from feed_transaction ft INNER JOIN feeds f ON f.feed_id = ft.feed_id WHERE ft.pig_id ='$pigid'))
	                   AND ft.date_given = (SELECT max(ft.date_given) from feed_transaction ft INNER JOIN feeds f ON f.feed_id = ft.feed_id WHERE ft.pig_id = '$pigid')
	                   AND ft.pig_id =  $pigid";
	        $result = mysqli_query($link, $query);
	        $feeds = array();
			$arr_feeds = array();
			while ($row = mysqli_fetch_row($result)) {
						$feeds['feedname'] = $row[0];
						$feeds['feed_type'] = $row[1];
						$arr_feeds[] = $feeds;
				}

				return $arr_feeds;
	    }
	    public function getLastMed($pigid)
	    {
	        $link   = $this->connect();
	        $query  = "SELECT m.med_name, 
	                        m.med_type, 
	                        mr.date_given
	                    FROM medication m 
	                        INNER JOIN med_record mr 
	                            ON mr.med_id = m.med_id 
	                   WHERE mr.time_given = (SELECT max(mr.time_given) from med_record mr INNER JOIN medication m ON m.med_id = mr.med_id WHERE mr.date_given = (SELECT max(mr.date_given) from med_record mr INNER JOIN medication m ON m.med_id = mr.med_id WHERE mr.pig_id ='$pigid'))
	                   AND mr.date_given = (SELECT max(mr.date_given) from med_record mr INNER JOIN medication m ON m.med_id = mr.med_id WHERE mr.pig_id = '$pigid')
	                   AND mr.pig_id =  $pigid";
	        $result = mysqli_query($link, $query);
	       $med = array();
			$arr_med = array();
			while ($row = mysqli_fetch_row($result)) {
						$med['medname'] = $row[0];
						$med['med_type'] = $row[1];
						$arr_med[] = $med;
				}

				return $arr_med;
	    }
	 	public function getPigsByPen($pen){
				$link = $this->connect();
				$pquery = "SELECT p.pig_id,
							rt.label 
						FROM pig p 
						INNER JOIN rfid_tags rt ON rt.pig_id = p.pig_id 
						WHERE p.pen_id = '" . $pen . "'
						ORDER BY p.pig_id ASC";
				$presult = mysqli_query($link, $pquery);
				$pig = array();
				$arr_pig = array();
				while ($row = mysqli_fetch_row($presult)) {
						$pig['pig_id'] = $row[0];
						$pig['lbl'] = $row[1];
						$arr_pig[] = $pig;
				}

				return $arr_pig;
		}
		public function getNextPigID()
		{
				$link = $this->connect();
				$search = "SELECT max(p.pig_id) FROM pig p ";
				$resultq = mysqli_query($link, $search);
				$row2 = mysqli_fetch_row($resultq);
				return $row2[0] + 1;
		}
		public function ddl_pig()
		{
			$link = $this->connect();
			$query = "SELECT  p.pig_id,
		    				  p.boar_id,
		                      p.sow_id,
		                      p.foster_sow,
		                      p.week_farrowed,
		                      p.gender,
		                      p.farrowing_date,
		                      p.pig_status,
		                      p.pen_id,
		                      p.breed_id,
		                      p.user,
		                      p.pig_batch,
		                      h.house_id,
		                      l.loc_id
		              FROM pig p
		              INNER JOIN pen pe ON 
		              p.pen_id = pe.pen_id
		              INNER JOIN house h ON
		              pe.house_id = h.house_id
		              INNER join location l ON
		              h.loc_id = l.loc_id
		              ORDER BY p.pig_id ASC";
		              
		    $result = mysqli_query ( $link, $query );
		   	$pig = array();
			$pig_arr = array();
			while ($row = mysqli_fetch_row($result))
		    {
		        $pig['pid'] = $row[0];
		        $pig['boar'] = $row[1];
		        $pig['sow'] = $row[2];
		        $pig['foster'] = $row[3];
		        $pig['week_far'] = $row[4];
		        $pig['gender'] = $row[5];
		        $pig['far_date'] = $row[6];
		        $pig['pig_stat'] = $row[7];
		        $pig['pen_id'] = $row[8];
		        $pig['breed_id'] = $row[9];
		        $pig['user'] = $row[10];
		        $pig['batch'] = $row[11];
		        $pig['h_id'] = $row[12];
		        $pig['loc_id'] = $row[13];
		        $pig_arr[] = $pig;

		    }
		 
		    return $pig_arr;
		}

		public function addParent($label, $label_id,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(parent_id)
					FROM parents";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO parents(parent_id,label,label_id) 
						VALUES('" . $max . "','" . $label . "','" . $label_id . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
	      			$this->userTransactionEdit($user,$max,"parent",0,$label,1,0);	
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function updateParent($parentid, $label, $label_id)
		{
				$link = $this->connect();
				$query = "UPDATE parents 
							set label = '" .$label. "',
								label_id = '" .$label_id. "'
						WHERE parent_id = '" . $parentid. "'";
				$result = mysqli_query($link, $query);
		}
		public function addBreed($breed_name,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(breed_id)
					FROM pig_breeds";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO pig_breeds(breed_id,breed_name) 
						VALUES('" . $max . "','" . $breed_name . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
	      			$this->userTransactionEdit($user,$max,"breed",0,$breed_name,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}

		public function updateBreed($breedname, $breedid)
		{
				$link = $this->connect();
				$query = "UPDATE pig_breeds 
							set breed_name = '" .$breedname. "'
						WHERE breed_id = '" . $breedid. "'";
				$result = mysqli_query($link, $query);
		}
		
		public function ddl_sow()
		{
				$link = $this->connect();
				$search = "SELECT DISTINCT parent_id, label_id
							FROM parents where label='sow';";
				$resultq = mysqli_query($link, $search);
				$sow = array();
				$sow_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {	
					$sow['parent_id'] =$row[0];
					$sow['label_id'] =$row[1];
					$sow_arr[] = $sow;
						
				}

				return $sow_arr;
		}
		public function ddl_boar()
		{
				$link = $this->connect();
				$search = "SELECT DISTINCT parent_id, label_id
							FROM parents where label='boar';";
				$resultq = mysqli_query($link, $search);
				$boar = array();
				$boar_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {	
					$boar['parent_id'] =$row[0];
					$boar['label_id'] =$row[1];
					$boar_arr[] = $boar;
						
				}

				return $boar_arr;
		}
		public function ddl_foster()
		{
				$link = $this->connect();
				$search = "SELECT DISTINCT parent_id, label_id
							FROM parents where label='sow';";
				$resultq = mysqli_query($link, $search);
				$sow = array();
				$sow_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {	
					$sow['parent_id'] =$row[0];
					$sow['label_id'] =$row[1];
					$fsow_arr[] = $sow;
						
				}

				return $fsow_arr;
		}

		public function ddl_parent()
		{
				$link = $this->connect();
				$search = "SELECT DISTINCT parent_id, label_id, label
							FROM parents";
				$resultq = mysqli_query($link, $search);
				$sow = array();
				$sow_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {	
					$sow['parent_id'] =$row[0];
					$sow['label_id'] =$row[1];
					$sow['label'] =$row[2];
					$fsow_arr[] = $sow;
						
				}

				return $fsow_arr;
		}
		public function getParentDetails($parent_id)
		{
				$link = $this->connect();
				$search = "SELECT DISTINCT parent_id, label_id, label
							FROM parents WHERE parent_id = '" .$parent_id. "'";
				$resultq = mysqli_query($link, $search);
				$sow = array();
				$sow_arr = array();
				while ($row = mysqli_fetch_row($resultq)) {	
					$sow['parent_id'] =$row[0];
					$sow['label_id'] =$row[1];
					$sow['label'] =$row[2];
					$fsow_arr[] = $sow;
						
				}

				return $fsow_arr;
		}
		public function ddl_breeds()
	    {
	        $link     = $this->connect();
	        $search   = "SELECT breed_id,breed_name FROM pig_breeds";
	        $resultq  = mysqli_query($link, $search);
	        $breed    = array();
	        $breedArr = array();
	        while ($row = mysqli_fetch_row($resultq)) {
	            $breed['brid']   = $row[0];
	            $breed['brname'] = $row[1];
	            $breedArr[]      = $breed;
	        }
	        return $breedArr;
	    }
	    public function searchBreed($br_name)
		{
				$link = $this->connect();
				$query = "SELECT breed_id,breed_name
						FROM pig_breeds 
						where breed_name LIKE '%".$br_name."%'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$breed = array();
				$arr_breed = array();
				while ($row = mysqli_fetch_row($result)) {
						$breed['loc_id'] = $row[0];
						$breed['loc_name'] = $row[1];
						$arr_breed[] = $breed;
				}

				return $arr_breed;
		}

		public function getBreed($br_id)
		{
				$link = $this->connect();
				$query = "SELECT breed_id,breed_name
						FROM pig_breeds 
						where breed_id = '".$br_id."'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$breed = array();
				$arr_breed = array();
				while ($row = mysqli_fetch_row($result)) {
						$breed['breed_id'] = $row[0];
						$breed['breed_name'] = $row[1];
						$arr_breed[] = $breed;
				}

				return $arr_breed;
		}
		


	    public function ddl_batch()
	    {
	        $link     = $this->connect();
	        $search   = "SELECT DISTINCT pig_batch FROM pig";
	        $resultq  = mysqli_query($link, $search);
	        $batch    = array();
	        $batchArr = array();
	        while ($row = mysqli_fetch_row($resultq)) {
	            $batch['batch']   = $row[0];
	            $batchArr[]      = $batch;
	         }
	        return $batchArr;
	    }
		public function ddl_pigpen($pig, $pen, $house, $location)
	    {
	        $link     = $this->connect();
	        $query    = "SELECT rt.label, 
	                        p.pig_id 
	                    FROM  rfid_tags rt 
	                        INNER JOIN pig p 
	                            ON p.pig_id = rt.pig_id 
	                        INNER JOIN pen pe 
	                            ON pe.pen_id = p.pen_id 
	                        INNER JOIN house h 
	                            ON h.house_id = pe.house_id 
	                    WHERE p.pen_id  = '" . $pen . "'
	                    AND p.pig_id != $pig 
	                    AND h.house_id = $house";
	        $result   = mysqli_query($link, $query);
	        $info     = "info";
	        $ppen     = array();
	        $arr_ppen = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $ppen['label'] = $row[0];
	            $ppen['pid']   = $row[1];
	            $arr_ppen[]    = $ppen;
	        }
	        return $arr_ppen;
	    }
	    public function ddl_pigpenall($pig, $pen, $house, $location)
	    {
	        $link     = $this->connect();
	        $query    = "SELECT rt.label, 
	                            p.pig_id 
	                    FROM  rfid_tags rt 
	                        INNER JOIN pig p 
	                            ON p.pig_id = rt.pig_id 
	                        INNER JOIN pen pe 
	                            ON pe.pen_id = p.pen_id 
	                        INNER JOIN house h 
	                            ON h.house_id = pe.house_id 
	                    WHERE p.pen_id  = '" . $pen . "'
	                    AND h.house_id = $house";
	        $result   = mysqli_query($link, $query);
	        $info     = "info";
	        $ppen     = array();
	        $arr_ppen = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $ppen['label'] = $row[0];
	            $ppen['pid']   = $row[1];
	            $arr_ppen[]    = $ppen;
	        }
	        return $arr_ppen;
	    }
	    public function ddl_perpen($pen){
	        $link     = $this->connect();
	        $query    = "SELECT 
	                        p.pig_id 
	                    FROM  pig p
	                        INNER JOIN pen pe 
	                            ON pe.pen_id = p.pen_id 
	                    WHERE p.pen_id  = '" . $pen . "' ";
	        $result   = mysqli_query($link, $query);
	        $ppen     = array();
	        $arr_ppen = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $arr_ppen[]    = $row[0];

	        }
	        return $arr_ppen;
	    }
	     public function ddl_perbatch($batch){
	        $link     = $this->connect();
	        $query    = "SELECT 
	                        p.pig_id 
	                    FROM  pig p
	                    WHERE p.pig_batch = '" . $batch . "' ";
	        $result   = mysqli_query($link, $query);
	        $arr_ppen = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $arr_ppen[]    = $row[0];

	        }
	        return $arr_ppen;
	    }
		public function updatepigRFID($pig_id, $rfid)
		{
				$link = $this->connect();
				$query = "UPDATE rfid_tags 
							set status = 'active', 
								pig_id = " . $pig_id . ", 
								label = '" . $pig_id . "'
						WHERE tag_id = '" . $rfid . "'";
				$result = mysqli_query($link, $query);
				$this->userTransactionEdit($user,0,"rfid",0,$rfid,1,$pig_id);
		}
		public function updatePigDetails($pig_id, $user, $stat,$prev)
		{
				$link = $this->connect();
				if ($stat == 'Dead') {
						$q = "SELECT h.house_id 
							FROM pig pi 
								INNER JOIN pen p 
									ON p.pen_id = pi.pen_id 
								INNER JOIN house h 
									ON h.house_id = p.house_id 
							WHERE pi.pig_id = '" . $pig_id . "'";
						$r = mysqli_query($link, $q);
						$row = mysqli_fetch_row($r);
						$q2 = "SELECT pen_id 
								from pen 
								where house_id=" . $row[0] . " 
								and function='mortality'";
						$r2 = mysqli_query($link, $q2);
						$row2 = mysqli_fetch_row($r2);
						$query = "UPDATE pig 
									set pig_status = '" . $stat . "', 
									pen_id = '" . $row2[0] . "', 
									user = '" . $user . "'
								WHERE pig_id = '" . $pig_id . "'";

				}
				else {
						$query = "UPDATE pig 
									set pig_status = '" . $stat . "', 
									user = '" . $user . "'
								WHERE pig_id = '" . $pig_id . "'";
				}
				if($stat!=$prev){
					$this->userTransactionEdit($user,0,"status",$prev,$stat,2,$pig_id);
				}
				

				$result = mysqli_query($link, $query);
		}
		public function updatePigWeight($pig_id,$prev, $weight, $record_id, $remarks,$prevremarks,$user)
		{
				$link = $this->connect();
				date_default_timezone_set("Asia/Manila");
				$d = date("Y-m-d");
				$t = date("h:i:s");
				$query = "UPDATE   weight_record
				set weight = '".$weight."',
				remarks = '".$remarks."'
				where record_id = '".$record_id."'";
				$result = mysqli_query($link, $query);
				if($weight!=$prev){
					$this->userTransactionEdit($user,0,"weight",$prev,$weight,2,$pig_id);
				}
				
				if($remarks!=$prevremarks){
					$this->userTransactionEdit($user,0,"weight type",$prevremarks,$remarks,2,$pig_id);
				}
		}
		public function updateWeekFar($user,$pig_id, $weekfar,$prev)
		{
				$link = $this->connect();
				$query = "UPDATE   pig
				set week_farrowed = '".$weekfar."'
				where pig_id = '".$pig_id."'";
				$result = mysqli_query($link, $query);
				if($weekfar!=$prev){
					$this->userTransactionEdit($user,0,"weekfar",$prev,$weekfar,2,$pig_id);
				}
		}
		public function updateRFIDdetails($pig_id, $rfid, $prevrfid, $plabel,$user)
		{
				$link = $this->connect();
				$query = "UPDATE rfid_tags 
						set status = 'lost', 
						pig_id = NULL, 
						label = '0'
						WHERE tag_id = '" . $prevrfid . "'";
				$result = mysqli_query($link, $query);
				$query = "UPDATE rfid_tags 
						set status = 'active', 
							pig_id = " . $pig_id . ", 
							label = '" . $plabel . "'
						WHERE tag_id = '" . $rfid . "'";
				$result = mysqli_query($link, $query);
				if($rfid!=$prevrfid){
					$this->userTransactionEdit($user,0,"rfid",$prevrfid,$rfid,2,$pig_id);	
				}
				
		}
		public function insertEditHistory($user, $pigid,$prevWeekFar,$newWeekFar, $prevStatus, $status, $prevrfid, $rfid,  $prevweight, $weight, $prevweighttype, $weightype)
		{
				$link = $this->connect();
				$query = "INSERT INTO edit_history(pig_id,prevWeekFar,newWeekFar,prevStatus, status, prevRFID, rfid, prevWeight, weight, prevWeightType, weightType,user,edit_date) 
							values('" . $pigid . "','" . $prevWeekFar . "','" . $newWeekFar . "','" . $prevStatus . "','" . $status . "','" . $prevrfid . "','" . $rfid . "','" . $prevweight . "','" . $weight . "','". $prevweighttype . "','" . $weightype . "','". $user . "', curdate());";
				
				//$result = mysqli_query($link, $query);
				
			    if ($result = mysqli_query( $link, $query )) {
			      	$data = array("success"=>"true",
				        "newId"=> $link->insert_id);
		      	}else {
			      	$data = array("success"=>"false",
	                  	"error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function addWeight($dateWeighed, $timeWeighed, $weight, $weightType, $pigid, $user)
		{
				$link = $this->connect();
				$q = "SELECT max(record_id)
					FROM weight_record";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO weight_record(record_date, record_time, weight, pig_id, remarks, user) 
							VALUES('" .$dateWeighed. "','" .$timeWeighed. "','" .$weight. "','" .$pigid. "','" .$weightType. "','" .$user. "');";
				
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
			        "newId"=> $link->insert_id);
			    }else {
			      $data = array("success"=>"false",
                  	"error"=>mysqli_error($link));
			    }
			    $this->userTransactionEdit($user,$max,"weight",0,$weight,1,$pigid);
			    return $data;
		}
		public function getPigWeight($pig)
		{
				$link = $this->connect();
				$query = "SELECT DISTINCT record_date,

							weight, 
							WEEK(record_date),
							record_time
						FROM weight_record 
						WHERE pig_id = '" . $pig . " '
						ORDER BY record_date ASC,record_time asc";
				$result = mysqli_query($link, $query);
				$dates = "";
				$weeks = "";
				$weights = "";
				$data = "";
				$data2 = 0;
				$arr = array();
				$ar_data = array();
				while ($row = mysqli_fetch_row($result)) {
						$ddate = $row[0];
						$wt = $row[1];
						$arr['color'] = '#83b26a';
						if($data2 > 0){
							if($data >= $wt){
								$arr['color'] = '#bb4230';

							}
						}
						
						$weekno = $row[2];
						$year = strtotime($ddate);
						$arr['year'] = date('F d,Y', $year);
						$dates = $ddate;
						$arr['week'] = $weekno;
						$arr['weight'] = $wt;
						$data = $wt;
						$ar_data[] = $arr;
						$data2++;
						
				}
				
				return $ar_data;
		}
		public function getWeightReport($var,$from,$to)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT 
							wr.record_date,
							wr.record_time,
							wr.weight,
							wr.remarks,
							wr.pig_id
							FROM weight_record wr 
							INNER JOIN pig p on
								wr.pig_id = p.pig_id
							WHERE wr.pig_id = '" . $var . "' and
							wr.date_given BETWEEN '".$from."' and '".$to."'";
				$result = mysqli_query($link, $query);
				$m = array();
				$m_arr = array();
				while($row = mysqli_fetch_row($result)){
					$m['Pig_id'] = $row[4];
					$date = date_create($row[0]);
					$m['Date_weighed'] = $date->format('F j,Y');
					$m['time_weighed'] = $row[1];
					$m['weight'] = $row[2];
					$m['remarks'] = $row[3];
					$m_arr[] = $m;
				}
				
				$fp = fopen(getenv("HOMEDRIVE") . getenv("HOMEPATH").'\\Desktop\\reports\\weight_reports\\wtrans_details.json', 'w');
				fwrite($fp, json_encode($m_arr,JSON_PRETTY_PRINT));
				fclose($fp);
				return $m_arr;
				
		}

			/* end of pig.php details */

		/*  med.php FUNCTIONS  */
		public function addMeds($mid, $mdate, $mtime, $pig,$qty,$unit,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(mr_id)
					FROM med_record";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO med_record(mr_id,date_given,time_given,quantity,unit,pig_id,med_id) 
							VALUES('" . $max . "','" . $mdate . "','" . $mtime . "','" . $qty . "','" . $unit . "','" . $pig . "','" . $mid . "');";
				$this->userTransactionEdit($user,$max,"medication",0,$mid,1,$pig);
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
			        "newId"=> $link->insert_id);
			    }else {
			      $data = array("success"=>"false",
                  	"error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function addMedName($mname, $mtype,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(med_id)
					FROM medication";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO medication(med_id,med_name,med_type) 
						VALUES('" . $max . "','" . $mname . "','" . $mtype . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      		$this->userTransactionEdit($user,$max,"medication name",0,$mname,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function getMedsDetails($var)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT med_id,
							med_type,
							med_name
							FROM medication 
							WHERE med_id = '" . $var . "'";
				$result = mysqli_query($link, $query);
				$m = array();
				$m_arr = array();
				while($row = mysqli_fetch_row($result)){
					$m['mid'] = $row[0];
					$m['mtype'] = $row[1];
					$m['mname'] = $row[2];
					$m_arr[] = $m;
				}
				
				
				return $m_arr;
				
		}
		public function getMedsTransDetails($var)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT mr.mr_id,
							mr.date_given,
							mr.time_given,
							mr.quantity,
							mr.unit,
							mr.pig_id,
							mr.med_id,
							m.med_name,
							m.med_type
							FROM med_record mr 
							INNER JOIN medication m on
								mr.med_id = m.med_id
							WHERE mr.med_id = '" . $var . "'";
				$result = mysqli_query($link, $query);
				$m = array();
				$m_arr = array();
				while($row = mysqli_fetch_row($result)){
					$m['mr_id'] = $row[0];
					$date = date_create($row[1]);
					$m['d_given'] = $date->format('F j,Y');
					$m['t_given'] = $row[2];
					$m['qty'] = $row[3];
					$m['unit'] = $row[4];
					$m['pid'] = $row[5];
					$m['m_id'] = $row[6];
					$m['fname'] = $row[7];
					$m['ftype'] = $row[8];
					$m_arr[] = $m;
				}
				
				
				return $m_arr;
				
		}
		public function getMedsReport($var,$from,$to)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT 
							mr.date_given,
							mr.time_given,
							mr.quantity,
							mr.unit,
							mr.pig_id,
							mr.med_id,
							m.med_name,
							m.med_type
							FROM med_record mr 
							INNER JOIN medication m on
								mr.med_id = m.med_id
							WHERE mr.pig_id = '" . $var . "' and
							mr.date_given BETWEEN '".$from."' and '".$to."'";
				$result = mysqli_query($link, $query);
				$m = array();
				$m_arr = array();
				while($row = mysqli_fetch_row($result)){
					$m['Pig_id'] = $row[4];
					$date = date_create($row[0]);
					$m['Date given'] = $date->format('F j,Y');
					$m['Time_given'] = $row[1];
					$m['Quantity'] = $row[2];
					$m['Unit'] = $row[3];
					$m['Feed_name'] = $row[6];
					$m['Feed_type'] = $row[7];
					$m_arr[] = $m;
				}
				
				$fp = fopen(getenv("HOMEDRIVE") . getenv("HOMEPATH").'\\Desktop\\reports\\medication_reports\\mtrans_details.json', 'w');
				fwrite($fp, json_encode($m_arr,JSON_PRETTY_PRINT));
				fclose($fp);
				return $m_arr;
				
		}
		// public function insertMedEditHistory($medid, $user, $mrid)
		// {
		// 		$link = $this->connect();
		// 		$query = "INSERT INTO med_edit_history(mr_id,med_id,user) values('" . $mrid . "','" . $medid . "','" . $user . "');";
		// 		$result = mysqli_query($link, $query);
		// }
		public function updateMeds($med_id, $mrid, $user)
		{
				$link = $this->connect();
				$query2 = "SELECT med_id,pig_id FROM med_record WHERE mr_id='" . $mrid . "'";
				$result2 = mysqli_query($link, $query2);
				$row = mysqli_fetch_row($result2);
				$query = "UPDATE med_record set med_id = '" . $med_id . "'WHERE mr_id = '" . $mrid . "'";
				$result = mysqli_query($link, $query);
				if ($result) {
						//$this->insertMedEditHistory($row[0], $user, $mrid);
						$this->userTransactionEdit($user,$mrid,"medication",$row[0],$med_id,2,$row[1]);
						return array(
								'success' => '1'
						);
				}
				else {
						return array(
								'success' => '0'
						);
				}

				echo "<script>alert('Successfully updated!');</script>";
		}
		 public function ddl_meds()
		{
				$link = $this->connect();
				$query = "SELECT med_id, 
							med_name,
							med_type 
						FROM medication";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$meds = array();
				$arr_med = array();
				while ($row = mysqli_fetch_row($result)) {
						$meds['med_id'] = $row[0];
						$meds['med_name'] = $row[1];
						$meds['med_type'] = $row[2];
						$arr_med[] = $meds;
				}

				return $arr_med;
		}
		public function ddl_medRecordEdit($pig)
	    {
	        $link      = $this->connect();
	        $query     = "SELECT m.med_name, 
	                        m.med_type, 
	                        mr.mr_id 
	                    FROM medication m 
	                        INNER JOIN med_record mr 
	                            ON mr.med_id = m.med_id 
	                    WHERE mr.pig_id = '" . $pig . "'
	                    order by mr.date_given desc";
	        $result    = mysqli_query($link, $query);
	        $mrcrd     = array();
	        $arr_mrcrd = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $mrcrd['mname'] = $row[0];
	            $mrcrd['mtype'] = $row[1];
	            $mrcrd['mr_id'] = $row[2];
	            $arr_mrcrd[]    = $mrcrd;
	        }
	        return $arr_mrcrd;
	    }
		public function ddl_medRecord($pig)
	    {
	        $link      = $this->connect();
	        $query     = "SELECT m.med_name, 
	                            m.med_type, 
	                            mr.mr_id, 
	                            mr.date_given,
	                            mr.quantity,
	                            mr.unit
	                    FROM medication m 
	                        INNER JOIN med_record mr 
	                            ON mr.med_id = m.med_id 
	                    WHERE mr.pig_id = '" . $pig . "'
	                     order by mr.date_given DESC";
	        $result    = mysqli_query($link, $query);
	        $mrcrd     = array();
	        $arr_mrcrd = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $mrcrd['mname']      = $row[0];
	            $mrcrd['mtype']      = $row[1];
	            $mrcrd['mrid']       = $row[2];
	            $date                = date('F d, Y', strtotime($row[3]));
	            $mrcrd['date_given'] = $date;
	            $mrcrd['qty'] = $row[4]." ".$row[5];
	            $arr_mrcrd[]         = $mrcrd;
	        }
	        return $arr_mrcrd;
	    }
	    public function updateMedication($medid, $medName, $medType)
		{
				$link = $this->connect();
				$query = "UPDATE medication 
							set med_name = '" .$medName. "',
								med_type = '" .$medType. "'
						WHERE med_id = '" . $medid. "'";
				$result = mysqli_query($link, $query);
		}

		/* end of meds.php FUNCTIONS*/


		/*  feeds.php FUNCTIONS  */
		public function addFeeds($fid, $fdate, $ftime, $pig, $proddate,$qty,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(ft_id)
					FROM feed_transaction";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO feed_transaction(ft_id,quantity,unit,date_given,time_given,pig_id,feed_id,prod_date) 
						VALUES('" . $max . "','" . $qty . "','kg','" . $fdate . "','" . $ftime . "','" . $pig . "','" . $fid . "','" . $proddate . "');";
				$this->userTransactionEdit($user,$max,"feeds",0,$fid,1,$pig);
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function addFeedName($fname, $ftype,$user)
		{
				$link = $this->connect();
				$q = "SELECT max(feed_id)
					FROM feeds";
				$r = mysqli_query($link, $q);
				$ro = mysqli_fetch_row($r);
				$max = $ro[0] + 1;
				$query = "INSERT INTO feeds(feed_id,feed_name,feed_type) 
						VALUES('" . $max . "','" . $fname . "','" . $ftype . "');";
				if ($result = mysqli_query( $link, $query )) {
		      	$data = array("success"=>"true",
		                    "newId"=> $link->insert_id);
		      		$this->userTransactionEdit($user,$max,"feed name",0,$fname,1,0);
			    }else {
			      $data = array("success"=>"false",
			                      "error"=>mysqli_error($link));
			    }
			    return $data;
		}
		public function getFeedsDetails($var)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT feed_id,
							feed_type,
							feed_name
							FROM feeds 
							WHERE feed_id = '" . $var . "'";
				$result = mysqli_query($link, $query);
				$f = array();
				$f_arr = array();
				while($row = mysqli_fetch_row($result)){
					$f['fid'] = $row[0];
					$f['ftype'] = $row[1];
					$f['fname'] = $row[2];
					$f_arr[] = $f;
				}
				
				

				return $f_arr;
				
		}
		public function getFeedTransDetails($var)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT ft.ft_id,
							ft.quantity,
							ft.unit,

							ft.date_given,
							ft.time_given,
							ft.pig_id,
							ft.feed_id,
							ft.prod_date,
							f.feed_name,
							f.feed_type
							FROM feed_transaction ft 
							INNER JOIN feeds f on
								ft.feed_id = f.feed_id
							WHERE ft.feed_id = '" . $var . "'";
				$result = mysqli_query($link, $query);
				$f = array();
				$f_arr = array();
				while($row = mysqli_fetch_row($result)){
					$f['ft_id'] = $row[0];
					$f['qty'] = $row[1];
					$f['unit'] = $row[2];
					$date = date_create($row[3]);
					$f['d_given'] = $date->format('F j,Y');
					$f['t_given'] = $row[4];
					$f['pid'] = $row[5];
					$f['f_id'] = $row[6];
					$date2 = date_create($row[7]);
					$f['proddate'] = $date2->format('F j,Y');
					$f['fname'] = $row[8];
					$f['ftype'] = $row[9];
					$f_arr[] = $f;
				}
				
				
				return $f_arr;
				
		}
		public function getFeedReport($var,$from,$to)
		{
				$link = $this->connect();
				$query = " SELECT DISTINCT
							ft.quantity,
							ft.unit,
							ft.date_given,
							ft.time_given,
							ft.pig_id,
							ft.prod_date,
							f.feed_name,
							f.feed_type
							FROM feed_transaction ft 
							INNER JOIN feeds f on
								ft.feed_id = f.feed_id
							WHERE ft.pig_id = '" . $var . "' and 
							ft.date_given BETWEEN '".$from."' and '".$to."'";
				$result = mysqli_query($link, $query);
				$f = array();
				$f_arr = array();
				while($row = mysqli_fetch_row($result)){
					$f['Pig_id'] = $row[4];
					$date = date_create($row[2]);
					$f['Date_given'] = $date->format('F j,Y');
					$f['Time given'] = $row[3];
					$f['Quantity'] = $row[0];
					$f['Unit'] = $row[1];
					$date2 = date_create($row[5]);
					$f['Production_Date'] = $date2->format('F j,Y');
					$f['Feed_name'] = $row[6];
					$f['Feed_type'] = $row[7];
					$f_arr[] = $f;
				}
				
				$fp = fopen(getenv("HOMEDRIVE") . getenv("HOMEPATH").'\\Desktop\\reports\\feed_reports\\feed_reports.json', 'w');
				fwrite($fp, json_encode($f_arr,JSON_PRETTY_PRINT));
				fclose($fp);
				return $f_arr;
				
		}
		public function ddl_feeds()
		{
				$link = $this->connect();
				$query = "SELECT feed_id, 
							feed_name,
							feed_type 
						FROM feeds";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$feeds = array();
				$arr_feed = array();
				while ($row = mysqli_fetch_row($result)) {
						$feeds['feed_id'] = $row[0];
						$feeds['feed_name'] = $row[1];
						$feeds['feed_type'] = $row[2];
						$arr_feed[] = $feeds;
				}

				return $arr_feed;
		}
		
	
		public function ddl_feedRecordEdit($pig)
	    {
	        $link      = $this->connect();
	        $query     = "SELECT f.feed_name, 
	                            f.feed_type, 
	                            ft.prod_date, 
	                            ft.ft_id
	                    FROM feeds f 
	                        INNER JOIN feed_transaction ft 
	                                ON ft.feed_id = f.feed_id 
	                    WHERE ft.pig_id = '" . $pig . "'
	                    order by ft.date_given DESC,ft_id asc";
	        $result    = mysqli_query($link, $query);
	        $frcrd     = array();
	        $arr_frcrd = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $frcrd['fname']    = $row[0];
	            $frcrd['ftype']    = $row[1];
	            $pd                = date('F d, Y', strtotime($row[2]));
	            $frcrd['proddate'] = $pd;
	            $frcrd['ft_id']    = $row[3];
	            $arr_frcrd[]       = $frcrd;
	        }
	        return $arr_frcrd;
	    }
	    public function ddl_feedRecord($pig)
	    {
	        $link      = $this->connect();
	        $query     = "SELECT f.feed_name, 
	                        f.feed_type, 
	                        ft.prod_date, 
	                        ft.ft_id,
	                        ft.quantity,
	                        ft.unit,
	                        ft.date_given 
	                    FROM feeds f 
	                        INNER JOIN feed_transaction ft 
	                            ON ft.feed_id = f.feed_id 
	                    WHERE ft.pig_id = '" . $pig . "'
	                    order by ft.date_given DESC";
	        $result    = mysqli_query($link, $query);
	        $frcrd     = array();
	        $arr_frcrd = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $frcrd['fname']      = $row[0];
	            $frcrd['ftype']      = $row[1];
	            $pd                  = date('F d, Y', strtotime($row[2]));
	            $frcrd['proddate']   = $pd;
	            $frcrd['ft_id']      = $row[3];
	            $date                = date('F d, Y', strtotime($row[6]));
	            $frcrd['date_given'] = $date;
	            $frcrd['qty'] = $row[4]." ".$row[5];
	            $arr_frcrd[]         = $frcrd;
	        }
	        return $arr_frcrd;
	    }
		// public function insertFeedsEditHistory($prev, $user,$mrid, $curr)
		// {
		// 		$link = $this->connect();
		// 		$query = "INSERT INTO feeds_edit_history(fr_id,prev_feed_id,curr_feed_id,user) values('" . $mrid . "','" . $prev . "','" . $curr . "','" . $user . "');";
		// 		$result = mysqli_query($link, $query);
		// }
		public function updateFeeds($fid, $ftid, $user)
		{
				$link = $this->connect();
				$query2 = "SELECT feed_id,pig_id FROM feed_transaction WHERE ft_id='" . $ftid . "'";
				$result2 = mysqli_query($link, $query2);
				$row = mysqli_fetch_row($result2);
				$query = "UPDATE feed_transaction set feed_id = '" . $fid . "'WHERE ft_id = '" . $ftid . "'";
				$result = mysqli_query($link, $query);
				if ($result) {
						//$this->insertFeedsEditHistory($row[0], $user, $ftid,$fid);
						$this->userTransactionEdit($user,$ftid,"feeds",$row[0],$fid,2,$row[1]);
						return array(
								'success' => '1'
						);
				}
				else {
						return array(
								'success' => '0'
						);
				}
		}
		public function updateFeedName($feedid, $feedName, $feedType)
		{
				$link = $this->connect();
				$query = "UPDATE feeds
							set feed_name = '" .$feedName. "',
								feed_type = '" .$feedType. "'
						WHERE feed_id = '" . $feedid. "'";
				$result = mysqli_query($link, $query);
		}
				
		/* end of feeds.php FUNCTIONS*/
		
		/*   movement.php FUNCTIONS */
		
		public function getPigMvmnt($pig)
		{
				$link = $this->connect();
				$query = "SELECT distinct m.date_moved, 
							m.pen_id, 
							p.pen_no, 
							h.house_no, 
							h.house_name,
							l.loc_name
						from movement m 
						INNER JOIN pen p 
							ON p.pen_id = m.pen_id 
						INNER JOIN house h 
							ON h.house_id = p.house_id 
						inner join location l on
							l.loc_id = h.loc_id
						where m.pig_id = '".$pig."'
						ORDER BY m.date_moved ASC,m.time_moved asc
							";
				$result = mysqli_query($link, $query);
				$data = "";
				$data2 = array();
				$housepen = "";
				while ($row = mysqli_fetch_row($result)) {
						if ($housepen == "") {
								$data2[] =$row[5]."-H" . $row[3] . "P" . $row[2];
						}
						else {
								$data2[] = $row[5]."-H" . $row[3] . "P" . $row[2];
						}
				}

				return $data2;
		}
		public function getWeekDateMvmnt($pig)
		{
				$link = $this->connect();
				$query = "SELECT DISTINCT m.date_moved,WEEK(m.date_moved), m.time_moved,p.pen_no,p.function
							
						from movement m 
						inner join pen p on
							p.pen_id = m.pen_id
						where m.pig_id = '".$pig."'
						ORDER BY m.date_moved ASC";
				$result = mysqli_query($link, $query);
				$data = array();
				$arr = array();
				$i = 1;
				$j = 0;
				$mvmnt = $this->getPigMvmnt($pig);
				while ($row = mysqli_fetch_row($result)) {
						$years = strtotime($row[0]);
						$data['date'] = date('F d,Y', $years);
						if($row[3]== 'medication' || $row[3] == 'mortality'){
							$i = $i * -1;
							
						}else{
							$i++;
						}
						$data['x'] = $i;
						$data['week'] = $row[1];
						$data['time_moved'] = $row[2];
						$data['pen']=$row[3];
						$data['move'] = $mvmnt[$j];

						$arr[] = $data;
						$j++;
						if($i < 0){
							$i = $i * -1;
						}
				}

				return $arr;
		}
		public function getMvmntDetails($pig,$from,$to)
		{
				$link = $this->connect();
				$query = "SELECT  m.date_moved,
								m.time_moved,
								p.pen_no,
								m.pig_id,
								h.house_name,
								l.loc_name
						from movement m 
						inner join pen p on
							p.pen_id = m.pen_id
						inner join house h on 
							h.house_id = p.house_id
						inner join location l on
							l.loc_id = h.loc_id
						where m.pig_id = '".$pig."'
						and m.date_moved BETWEEN '".$from."' and '".$to."'
						ORDER BY m.date_moved ASC";
				$result = mysqli_query($link, $query);
				$data = array();
				$arr = array();
				$i = 1;
				$j = 0;
				$mvmnt = $this->getPigMvmnt($pig);
				while ($row = mysqli_fetch_row($result)) {
						$data['pig_id'] = $row[3];	
						$data['date_moved'] = $row[0];
						$data['time_moved'] = $row[1];
						$data['location_name'] = $row[5];
						$data['house_name'] = $row[4];
						$data['pen_no'] = $row[2];
						
						$arr[] = $data;
						
				}
				//$arr = str_replace("},{", "}\n{", $arr);

				$fp = fopen(getenv("HOMEDRIVE") . getenv("HOMEPATH").'\\Desktop\\reports\\movement_reports\\movment_report.json', 'w');
				fwrite($fp, json_encode($arr,JSON_PRETTY_PRINT));
				fclose($fp);
				return $arr;
		}
		/* end of movement.php FUNCTIONS*/
		/*  rfid.php  FUNCTIONS*/
		public function ddl_inactiveRFID()
	    {
	        $link   = $this->connect();
	        $query  = "SELECT tag_rfid, 
	                        tag_id 
	                    FROM rfid_tags 
	                    WHERE status = 'inactive'";
	        $result = mysqli_query($link, $query);
	        $rfid   = array();
	        $arr    = array();
	        while ($row = mysqli_fetch_row($result)) {
	            $rfid['rfid']   = $row[0];
	            $rfid['tag_id'] = $row[1];
	            $arr[]          = $rfid;
	        }
	        return $arr;
	    }




	    public function getUserEdited($pigid)
	    {
	        $link   = $this->connect();
	        $query  = "SELECT user FROM pig WHERE pig_id = '" . $pigid . "'";
	        $result = mysqli_query($link, $query);
	        $row    = mysqli_fetch_row($result);
	        return $row[0];
	    }
	    
		
	}
?>
