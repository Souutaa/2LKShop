<?php foreach ($productSeller->productSeller as $product): ?>
                                <tr>
                                  <td style="w-75">
                                    <h5 class="font-14 my-1 fw-normal w-75 text-lg-left text-wrap">
                                    <?php echo $product->getProductLine() ?>
                                    </h5>
                                    <span class="text-muted font-13"><?php echo $product->getCreatedAt() ?></span>
                                  </td>
                                  <td>
                                    <h5 class="font-14 my-1 fw-normal"><?php echo number_format($product->getPrice()) ?>đ</h5>
                                    <span class="text-muted font-13">Price</span>
                                  </td>
                                  <td>
                                    <h5 class="font-14 my-1 fw-normal"><?php echo $product->getTotalOrder() ?></h5>
                                    <span class="text-muted font-13">Quantity</span>
                                  </td>
                                  <td>
                                    <h5 class="font-14 my-1 fw-normal"><?php echo number_format($product->getPrice() * $product->getTotalOrder()) ?>đ</h5>
                                    <span class="text-muted font-13">Amount</span>
                                  </td>
                                </tr>
              <?php endforeach ?>