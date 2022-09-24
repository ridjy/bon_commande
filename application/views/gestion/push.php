<?php 
		 echo '<script type="text/javascript">';
		 echo '</script>';
		 echo '<script>';
		 echo 'Push.create("Notification",{ 
		 					body :' ;
		 echo '"'.$val.'",' ;
		 echo '		icon: \'' ;
		 echo $img ;
		 echo "',";
		 echo '
		 			timeout:4000,
					onClick: function () {
						window.focus();
						this.close();
					}

				});
			</script>';
?>