<?php 
class uploadlibrary
{
	private $CI;
	function __construct()
	{
		$this->CI = & get_instance();

	}
	function uploadFile($mediatype,$FILES)
	{
		$post_array = array();
		$ret_array = array();
        $iCount = 1 ;
        while(list($key,$value) = each($FILES[$mediatype]['tmp_name']))
		{
			if(!empty($value))
			{
				$post_array['file'.$iCount] = "@".$FILES[$mediatype]['tmp_name'][$key];
				$post_array['type'.$iCount] = $FILES[$mediatype]['type'][$key];
				$post_array['name'.$iCount] = $FILES[$mediatype]['name'][$key];
				$iCount = $iCount + 1;

			}
		}
		$post_array['mediatype']=$mediatype;
		$post_array['count'] = $iCount;

		$files = $this->fomratFileStreamData($FILES);


        $output=  $this->prepareUploadData($post_array,$files);

		$responseObj = unserialize($output);

		$mediadata = array();
		$i = 0;
		if($responseObj["status"] == 1)
		{



                for($i=0;$i < (count($responseObj) - 1); $i++ )
                {
                    switch($mediatype) {
                        case 'image':
                        array_push($ret_array,array('mediaid' => $responseObj[$i]['mediaid'],'imageurl' => $responseObj[$i]['imageurl'],'title' => $responseImageCaption[$i+1],'thumburl' => $responseObj[$i]['thumburl'],'thumburl_m' => $responseObj[$i]['thumburl_m']));
                            break;
                        case 'pdf':
                        array_push($ret_array,array('mediaid' => $responseObj[$i]['mediaid'],'imageurl' => $responseObj[$i]['pdfurl'],'title' => $responseImageCaption[$i+1],'thumburl' => $responseObj[$i]['pdfurl']));
                            break;
                    }
                }
                $ret_array['max'] = $i;
                $ret_array['status'] = 1;
                return $ret_array;
            }
			else
			{

	            return $responseObj["error_msg"];
			}
	}
	function fomratFileStreamData()
	{
		$i = 1;
		$files = array();
		while(list($key,$value) = each($_FILES['uploads']))
		{
			$files['file'.$i][$key] = $value[0];
		}

		return $files;
	}
	function prepareUploadData($applicationData,$FILES)
	{
		$mediatype = $applicationData['mediatype'];
		$iCount = $applicationData['count'];
		$id = $applicationData['Id'];
		$type = $applicationData['type'];
		$i = 1;
		$arrayofdescription = array();
		while($i < $iCount)
		{
			$arrayofdescription['description'.$i] = $applicationData['description'.$i];
			$arrayofdescription['type'.$i] = $applicationData['type'.$i];
			$arrayofdescription['name'.$i] = $applicationData['name'.$i];
			$i = $i + 1;
		}
		switch($mediatype)
		{
			case "pdf":
				       $iFlag = $this->insertPdf($FILES,$arrayofdescription,$iCount,$id,$type);
					   break;
			case "image":
						$iFlag = $this->insertimage($FILES,$arrayofdescription,$iCount,$id,$type);
						break;
		}
		if(!isset($iFlag))
		{
			$returnarray = array("status"=>0,"error_msg"=>$iFlag);
			return serialize($returnarray);
		}
		return $iFlag;
	}
	function checktype($iCount,$FILES)
	{
		$iFlag = 1;
		$TypeFlag = 1;
		while($iFlag < $iCount)
		{
			$size = getimagesize($FILES['file'.$iFlag]['tmp_name']);
			$type = $size['mime'];
			if(!($type== "image/gif" || $type== "image/jpeg"|| $type=="image/jpg" || $type== "image/png"))
				{ $TypeFlag = 0; break; }
			else
				$TypeFlag = 1;
			$iFlag ++;
		}
		return $TypeFlag ;
	}
	function insertimage($FILES,$arrayofdescription,$iCount,$id,$typeofmedia)
	{

        if($FILES['file1']['tmp_name'] == '')
			return ("File uploading failed");

		define("MAX_IMAGE_SIZE","5242880");
		$sizevar = "5 Mb";

	if(!$this->checktype($iCount,$FILES))
	{
		$errorArr['status'] = 0;
		$errorArr['error_msg'] = "Images of type jpeg,gif,png are allowed";
		return serialize($errorArr);
	}
	if(!$this->checksize($FILES,$iCount,MAX_IMAGE_SIZE))
	{
		$errorArr['status'] = 0;
		$errorArr['error_msg'] = "Size limit of ".$sizevar." exceeded";
		return serialize($errorArr);
	}
        $ImagesPath = MEDIA_BASE_PATH."/images";

        if( !(file_exists($ImagesPath) && is_dir($ImagesPath)) ) {
            @mkdir($ImagesPath, 0777);
        }

		$iSuccess = 1;
		$iFlag = 1;
		$mediaid = 0;
		$date = date("y.m.d");
		while($iFlag < $iCount)
		{
			//Set the values
			$name_id = time().basename($FILES['file'.$iFlag]['tmp_name']);


			//$imageurl = URL ."/mdb_image/server/images/".$name_id;
			$media= getimagesize($FILES['file'.$iFlag]['tmp_name']);
			$type = $media['mime'];
			//$ext = substr($type,-1* (strpos($type,"/") - 1));
			//$ext = basename($FILES['file'.$iFlag]['tmp_name']);
			$ext = basename($type);
			$size = $FILES['file'.$iFlag]['size'];
			$target_location = $ImagesPath."/".$name_id.'.'.$ext;
			$name = $FILES['file'.$iFlag]['name'];

			$varientExtension = (strtolower($ext) == 'jpeg') ? 'jpg' : $ext;
			
			$imageurl = "/mediadata/images/".$name_id.'.'.$ext;
			$image153x153   = $ImagesPath."/".$name_id."_m.".$varientExtension;
			$image98x98  = $ImagesPath."/".$name_id."_s.".$varientExtension;
			$image350x350 = $ImagesPath."/".$name_id."_l.".$varientExtension;
			

			
			$description = $arrayofdescription['description'.$iFlag];

			if(!(move_uploaded_file($FILES['file'.$iFlag]['tmp_name'],$target_location)))
			{
				if($FILES['uploadedFile']['error'] > 0)
				{
					switch($FILES['uploadFile'] ['error'])
					{
						case 1: return "File exceeded maximum server upload size";
							break;
						case 2: return "File exceeded maximum file size";
							break;
						case 3: return "File only partially uploaded";
							break;
						case 4: return "File not uploaded";
							break;
					}
				}
				$iSuccess = 0;
				break;
			}
			else
			{
				$returnarray[$iFlag-1]['imageurl']= $imageurl;
			}
			$iFlag = $iFlag + 1;
		}
		if(!$iSuccess)
			return("File uploading failed.Please try again");
		else
			$returnarray["status"] = 1;

		return serialize($returnarray);


	}
	function insertPdf($FILES,$arrayofdescription,$iCount,$id,$type)
	{
		define("MAX_PDF_SIZE","52428800");
		$sizevar = "50 Mb";
		$date = date("y.m.d");
		$PdfPath = MEDIA_BASE_PATH."/pdf/";
		while($iFlag <$iCount)
		{
			$type = $arrayofdescription['type'.$iFlag];
			if($this->checkDocumenttype($type)){
	            $TypeFlag = 1;
	            if($type == "application/octet-stream")
				{
					$originalNameArr = explode('.', $arrayofdescription['name'.$iFlag]);
					$ext  = $originalNameArr[count($originalNameArr)-1];
					if(!in_array($ext,array("msg"))){
						$TypeFlag = 0;
					}
				}
	        }
			else
				$TypeFlag = 0;

			$iFlag ++;
		}
		
		if($TypeFlag == 0) // && $typeofmedia =='uploadFromCRDashboard') now all cases allow same file types, therefore this condition is not required
		{
			$errorArr['status'] = 0;
			$errorArr['error_msg'] = "Only pdf, ppt, pptx, doc, docx, xls, xlsx, txt, msg files are allowed";
			return serialize($errorArr);
		}

		$iFlag = 1;
		$iSuccess = 1;
		while($iFlag < $iCount)
		{

			$name_id = time().basename($applicationData['file'.$iFlag]);
			$target_location = $PdfPath.$name_id;
			$size = $FILES['file'.$iFlag]['size'];
			$type = $FILES['file'.$iFlag]['type'];
			$type = $arrayofdescription['type'.$iFlag];
			$pdfurl = "/mediadata/pdf/".$name_id;
			if($type == "application/msword")
			{
				$target_location .= '.doc';
				$pdfurl .= '.doc';
			}
			if($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
			{
				$target_location .= '.docx';
				$pdfurl .= '.docx';
			}			
			if($type == "application/pdf" || $type == '"application/pdf"')
			{
				$target_location .= '.pdf';
				$pdfurl .= '.pdf';
			}
			//_p($target_location);die;
			if(!(move_uploaded_file($FILES['file'.$iFlag]['tmp_name'],$target_location)))
			{
				$iSuccess = 0;
				break;
			}
			else
			{
				$returnarray[$iFlag-1]['pdfurl']= $pdfurl;
			}

			$iFlag = $iFlag + 1;
		}
		if(!$iSuccess)
		{
			$errorArr['status'] = 0;
			$errorArr['error_msg'] = "file uploading failed.Please try again";
			return serialize($errorArr);
		}
		else
			$returnarray["status"] = 1;
		return serialize($returnarray);
	}
	function checkDocumenttype($type)
	{
	    $type = strtolower(trim($type,'"\' '));
		if(!($type == "application/msword" ||
			 $type =="application/pdf" ||
			 $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
			)
		)
			return  0;
		else
			return 1;
	}
	function checksize($FILES,$iCount,$Max_Size)
	{
		$iFlag = 1;
		$SizeFlag = 1;
		while($iFlag < $iCount)
		{
			$size = $FILES['file'.$iFlag]['size'];		
			if($size > $Max_Size)
				{ $SizeFlag = 0;
				  break;
				}
			else
				$SizeFlag = 1;
			$iFlag ++;
		}
		return $SizeFlag;
	}
}
?>