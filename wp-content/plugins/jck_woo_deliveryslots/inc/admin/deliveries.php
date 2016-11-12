<?php

/* 	=============================
   	Output a listing of all pending reservations, ordered by date 
   	============================= */
   	
   	$tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'upcoming-deliveries';
   	
	echo '<div class="wrap">';
		
		echo '<h2 class="nav-tab-wrapper" style="margin-bottom: 20px;">';
			echo '<a href="'.admin_url('admin.php?page='.$this->slug.'-deliveries').'" class="nav-tab '.($tab == 'upcoming-deliveries' ? 'nav-tab-active' : '').'">'.__('Upcoming Deliveries', $this->slug).'</a>';
			echo '<a href="'.admin_url('admin.php?page='.$this->slug.'-deliveries&tab=currently-reserved').'" class="nav-tab '.($tab == 'currently-reserved' ? 'nav-tab-active' : '').'">'.__('Currently Reserved', $this->slug).'</a>';
		echo '</h2>';
		
		if($tab == 'upcoming-deliveries'){		
			$upcomingDeliveries = $this->get_reservations(1);		
			$this->reservations_layout($upcomingDeliveries);
		}
		
		if($tab == 'currently-reserved'){
			$upcomingReservations = $this->get_reservations(0);
			$this->reservations_layout($upcomingReservations);
		}
		
	echo '</div>';
	
	
	
	
	
	
	
