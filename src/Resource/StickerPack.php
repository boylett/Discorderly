<?php

	namespace Discorderly\Resource;

	class StickerPack extends \Discorderly\Resource\AbstractStaticResource {
		/**
		 * Id of the sticker pack
		 * @var int
		 */
		public $id = 0;
		
		/**
		 * The stickers in the pack
		 * @var array
		 */
		public NULL|array $stickers = [];
		
		/**
		 * Name of the sticker pack
		 * @var string
		 */
		public NULL|string $name = "";
		
		/**
		 * Id of the pack's SKU
		 * @var int
		 */
		public NULL|int $sku_id = 0;
		
		/**
		 * Id of a sticker in the pack which is shown as the pack's icon
		 * @var int
		 */
		public NULL|int $cover_sticker_id = 0;
		
		/**
		 * Description of the sticker pack
		 * @var string
		 */
		public NULL|string $description = "";
		
		/**
		 * Id of the sticker pack's banner image
		 * @var int
		 */
		public NULL|int $banner_asset_id = 0;

		/**
		 * Recursively populate this instance with a data set
		 * @param  array $properties Instance data
		 * @return self
		 */
		public function __populate(array $properties) : self {
			foreach ($properties["stickers"] ?? [] as $index => $sticker) {
				$properties["stickers"][$index] = $this->parent->Sticker($sticker["id"])->__populate($sticker);
			}

			return parent::__populate($properties);
		}
	}
