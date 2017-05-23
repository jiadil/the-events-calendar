<?php

class Tribe__Events__Validator__Base extends Tribe__Validator__Base
	implements Tribe__Events__Validator__Interface {
	/**
	 * Whether the provided value is an existing Venue post ID or not.
	 *
	 * @param mixed $venue_id
	 *
	 * @return bool
	 */
	public function is_venue_id( $venue_id ) {
		return $this->is_numeric( $venue_id ) && tribe_is_venue( $venue_id );
	}

	/**
	 * Whether the provided value is an existing Organizer post ID or not.
	 *
	 * @param mixed $organizer Either an array of Organizer post IDs or a single Organizer post ID.
	 *
	 * @return bool
	 */
	public function is_organizer_id( $organizer ) {
		$organizers = array_filter( (array) $organizer, 'is_numeric' );

		if ( empty( $organizers ) || count( $organizers ) !== count( (array) $organizer ) ) {
			return false;
		}

		return count( array_filter( $organizers, 'tribe_is_organizer' ) ) === count( $organizers );
	}

	/**
	 * Whether the event category exists or not.
	 *
	 * @param mixed  $category Either a single event category `term_id` or `slug` or an array of
	 *                     `term_id`s and `slug`s
	 * @return bool
	 */
	public function is_event_category( $category ) {
		return $this->is_term_of_taxonomy( $category, Tribe__Events__Main::TAXONOMY );
	}
}