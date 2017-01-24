<?php namespace LasseRafn\Ordrestyring\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request extends RequestBuilder
{
	/** @var Client */
	protected $client;

	/** @var string */
	protected $primaryKey = 'id';

	/** @var string */
	protected $endpoint = '';

	public function __construct( Client $client )
	{
		$this->client = $client;
	}

	/**
	 * Find one entity by the primary key
	 *
	 * @param int $id
	 */
	public function find( int $id )
	{
		$this->where( $this->primaryKey, $id )
		     ->page( 1 )
		     ->perPage( 1 )
		     ->buildRequest();

		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );
	}

	/**
	 * Get the first entity based on the query
	 */
	public function first()
	{
		$this->page( 1 );
		$this->perPage( 1 );
		$this->get();

		$this->buildRequest();

		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );
	}

	/**
	 * Get a collection of entities based on the query
	 */
	public function get()
	{
		$this->buildRequest();

		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );
	}

	/**
	 * Get a collection of all entities based on a query
	 * This method will automatically paginate all rows,
	 * and bypass any page attribute that has been set.
	 */
	public function all()
	{
		$this->buildRequest();

		$response = $this->getResponse( function ()
		{
			return $this->client->get( "{$this->endpoint}{$this->urlParameters}" );
		} );
	}

	public function create( $data )
	{

	}

	public function update( $primaryKey, $data )
	{

	}

	public function delete( $primaryKey )
	{

	}

	private function getResponse( callable $callable )
	{
//		try {
			return $callable();
//		}
//		catch( ClientException $clientException)
//		{
//			return false;
//		}
//		catch(\Exception $exception)
//		{
//			return false;
//		}
	}
}