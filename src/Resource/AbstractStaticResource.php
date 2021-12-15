<?php

	namespace Discorderly\Resource;

	abstract class AbstractStaticResource {
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
		 * If a matching instance exists, retrieve it from the cache. If not, create one
		 * @param  array ...$arguments Parameters to compare against
		 * @return self
		 */
		public static function __instance(...$arguments) : self {
			$class = \get_called_class();

			if (!empty($arguments) or (\count($arguments) === 1 and isset($arguments["parent"]))) {
				$contenders = \Discorderly\Discorderly::array_find(static::$discorderly_instance_cache[$class] ?? [], $arguments);

				if (!empty($contenders)) {
					return \reset($contenders);
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
					"dirty",
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