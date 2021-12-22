<?php

	namespace Discorderly\Resource;

	abstract class AbstractStaticResource {
		/**
		 * Whether the data for this instance has been fetched already
		 * @var bool
		 */
		protected bool $dirty = false;

		/**
		 * Instance cache
		 * @var array
		 */
		protected static $discorderly_instance_cache = [];

		/**
		 * Parent controller instance
		 * @var \Discorderly\Discorderly
		 */
		public \Discorderly\Discorderly $parent;

		/**
		 * Populate the instance with its data
		 */
		public function __construct(...$arguments) {
			$this->__populate($arguments);
		}

		/**
		 * Property getter
		 * @param  string $method    Method name
		 * @param  array  $arguments Method arguments
		 * @return mixed             Property value
		 */
		public function __call(string $method, array $arguments = []) : mixed {
			if (\preg_match("/^get([a-zA-Z]+)$/i", $method, $property)) {
				$property = \strtolower(\preg_replace(["/([a-z\d])([A-Z])/", "/([^_])([A-Z][a-z])/"], "$1_$2", $property[1]));

				if (\property_exists($this, $property)) {
					return $this->{$property} ?? NULL;
				}

				else {
					throw new \Discorderly\Response\Exception("Undefined property: \\" . \get_called_class() . "::" . $property);
				}

				return NULL;
			}

			throw new \Discorderly\Response\Exception("Call to undefined method \\" . \get_called_class() . "::" . $method . "()");
		}

		/**
		 * If a matching instance exists, retrieve it from the cache. If not, create one
		 * @param  array ...$arguments Parameters to compare against
		 * @return self
		 */
		public static function __instance(...$arguments) : self {
			$class = \get_called_class();

			if (!empty($arguments) or (\count($arguments) === 1 and isset($arguments["parent"]))) {
				$contenders = \Discorderly\Discorderly::array_find(static::$discorderly_instance_cache[$class] ?? [], $arguments);

				if (!empty($contenders)) {
					$instance = \reset($contenders);

					if (isset($this->parent) and $instance instanceof \Discorderly\Response\AbstractStaticResource) {
						$this->parent->adopt($instance);
					}

					return $instance;
				}
			}

			$reflection = new \ReflectionClass($class);
			$instance   = $reflection->newInstanceArgs($arguments);

			static::$discorderly_instance_cache[$class][] = $instance;

			return $instance;
		}

		/**
		 * Recursively populate this instance with a data set
		 * @param  array $properties Instance data
		 * @return self
		 */
		public function __populate(array $properties) : self {
			foreach ($properties as $property => $value) {
				if (\property_exists($this, $property)) {
					$reflection      = new \ReflectionProperty($this, $property);
					$reflection_type = $reflection->getType();
					$type            = $reflection_type?->getName() ?: "mixed";

					switch (true) {
						case (\is_a($type, __CLASS__, true)): {
							if ($value instanceof $type) {
								$this->{$property} = $value;

								break;
							}
							
							$id = 0;

							if (\is_array($value) and \is_numeric($value["id"] ?? false)) {
								$id = $value["id"];
							}

							else if (\is_numeric($value)) {
								$id = $value;
							}

							else {
								throw new \Discorderly\Response\Exception("Value of `" . $property . "` is incompatible with " . $type);
							}

							$this->{$property} = new $type(
								parent: $this->parent,
								id:     $id,
							);

							if (\is_array($value)) {
								$this->{$property}->__populate($value);
							}
						}

						break;

						case (\is_a($type, "DateTime", true)): {
							if ($value == 0) {
								$this->{$property} = NULL;
							}

							else {
								$this->{$property} = \DateTime::createFromFormat("U", \strtotime($value) ?: 0);
							}
						}

						break;

						default: {
							$this->{$property} = $value;
						}

						break;
					}
				}
			}

			return $this;
		}

		/**
		 * Do not include the parent if this instance is serialized
		 * @return array
		 */
		public function __serialize() : array {
			return $this->__toArray(true);
		}

		/**
		 * Recursively convert this instance to an array
		 * @param  bool  $is_serializing Whether we are normalizing this array for serialization
		 * @return array
		 */
		public function __toArray(bool $is_serializing = false) : array {
			$array = [];

			foreach (\get_object_vars($this) as $property => $value) {
				if (!$is_serializing) {
					if ($value instanceof static) {
						$value = $value->__toArray();
					}

					if ($value instanceof \DateTime) {
						$value = $value->format("Y-m-d\TH:i:s\.uP");
					}

					else if (\is_object($value)) {
						$value = \json_decode(\json_encode($value), true);
					}
				}

				if (!\in_array($property, [
					"endpoint",
					"parent",
				])) {
					$array[$property] = $value;
				}
			}

			return $array;
		}

		/**
		 * Clear the instance cache
		 */
		public static function clearCache() {
			static::$discorderly_instance_cache = [];
		}

		/**
		 * Export this object as an array
		 * @param  array|NULL $keys Which properties to export
		 * @return array
		 */
		public function export(array|NULL $keys = NULL) : array {
			$array = $this->__toArray();

			unset($array["dirty"]);

			if ($keys !== NULL) {
				$export = [];

				foreach ($keys as $property) {
					$export[$property] = $array[$property];
				}

				return $export;
			}

			return $array;
		}
	}