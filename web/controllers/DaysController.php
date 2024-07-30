<?php

class DaysController
{

	public function daySelect($selectedDay)
	{
		$days = DaysModel::days();

		foreach ($days as $day) {
			$selected = $day['id_day'] == $selectedDay ? 'selected' : '';
			echo '<option value="' . $day['id_day'] . '" ' . $selected . '>' . $day['details'] . '</option>';
		}
	}

	public function allDaysSelect()
	{

		$days = DaysModel::days();

		foreach ($days as $key => $value) {
			echo '<option value="' . $value['id_day'] . '">' . $value['details'] . '</option>';
		}
	}

}

?>