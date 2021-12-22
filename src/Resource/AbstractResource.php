<?php

	namespace Discorderly\Resource;

	abstract class AbstractResource extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * The object's unique ID
		 * @var int
		 */
		public $id = 0;

		/**
		 * API endpoint path
		 * @var string
		 */
		public string $endpoint = "";

		/**
		 * Populate the instance with its data and require instances to have a valid parent instance
		 */
		public function __construct(...$arguments) {
			if (!isset($arguments["parent"]) or !\is_a($arguments["parent"], "\\Discorderly\\Discorderly")) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$this->__populate($arguments);
		}

		/**
		 * Create a new instance
		 * @param  string $endpoint Relative path to Discord API endpoint
		 * @return static           The new instance
		 */
		public function create(...$arguments) : static {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$endpoint = $arguments["endpoint"] ?? "";

			unset($arguments["endpoint"]);

			$response = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . \rtrim($this->endpoint . $endpoint, "/"),
				type:     "post",
				data:     $arguments,
			);

			$object = new static(parent: $this->parent);

			return $object->__populate($response);
		}

		/**
		 * Delete this instance
		 * @param  string $endpoint Relative endpoint to request (defaults to '/<id>')
		 * @return bool
		 */
		public function delete(...$arguments) : bool {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			try {
				$this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . $this->endpoint . \rtrim(($arguments["endpoint"] ?? false) ?: (empty($this->id ?? 0) ? "" : ("/" . $this->id)), "/"),
					type:     "delete",
					data:     $arguments ?: NULL,
				);

				$this->id    = 0;
				$this->dirty = false;
			}

			catch (\Exception $e) {
				// If this is an "Unknown Item" error, looks like it's already been deleted. Nice!
				if ($e->getCode() >= 10001 and $e->getCode() <= 10071) {
					return true;
				}

				throw $e;
			}

			return true;
		}

		/**
		 * Get the instance's data
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return static               The updated instance
		 */
		public function get(...$arguments) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$endpoint          = $arguments["endpoint"]          ?? "";
			$endpoint_override = $arguments["endpoint_override"] ?? false;

			unset($arguments["endpoint"], $arguments["endpoint_override"]);

			if (!$this->dirty) {
				$response = $this->parent->request(
					endpoint: \Discorderly\Discorderly::endpoint . \rtrim($endpoint_override ?: ($this->endpoint . $endpoint), "/"),
					type:     "get",
					data:     $arguments,
				);

				$this->__populate($response);

				$this->dirty = true;
			}

			return $this;
		}

		/**
		 * Modify this instance
		 * @param  string $endpoint     Relative path to Discord API endpoint
		 * @param  array  ...$arguments Payload to send to the Discord API
		 * @return self                 The updated instance
		 */
		public function modify(...$arguments) : self {
			if (!isset($this->parent)) {
				throw new \Discorderly\Response\OrphanedInstanceException();
			}

			$endpoint = $arguments["endpoint"] ?? "";

			unset($arguments["endpoint"]);

			$response = $this->parent->request(
				endpoint: \Discorderly\Discorderly::endpoint . \rtrim($this->endpoint . $endpoint, "/"),
				type:     "patch",
				data:     $arguments,
			);

			$this->__populate($response);

			return $this;
		}
	}
