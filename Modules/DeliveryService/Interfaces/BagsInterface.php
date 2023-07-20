<?php

namespace Modules\DeliveryService\Interfaces;

interface BagsInterface
{
 public function addNewBag($partner_id, $qrCode,$bagNumber,$bagSize,$bagType,$weight, $dimensions, $status = "Available");
 public function updateBag($id,$partner_id,$qrCode,$bagNumber,$bagSize,$bagType,$status,$weight,$dimensions);
 public function getBag($id);
 public function deleteBag($id);
 public function getBags();
 public function filterBags($status);

}
