<div class="table-responsive"> 
    							<table class="table table-bordered table-striped table-hover table-sm">
						            <thead>
							            <tr>
							                <th>SL</th>
							                <th>Product Name</th>
							                <th>Qty</th>
							                <th>Price</th>
							                <th>Subtotal</th>
							                <th>Delete</th>
							            </tr>
						            </thead>

						            <tbody>
						            <?php
							            $i=1;
							            $allTotal = 0;
						            ?>
						            @foreach($addedList as $key=>$item)
						                <tr>
						                    <td>{{ $i++ }}</td>
						                    <td>{{ $item->name }}</td>
						                    <td>{{ $item->qty }}</td>
						                    <td>{{ $item->price }}</td>
						                    <td>{{ $item->subtotal }}</td>
						                    <td>
						                        <button type="button" class="delete-cart-item btn btn-outline-danger btn-xs fa fa-trash" id="{{ $key }}" style="color: #FFFFFF;">Delete</button>
						                    </td>

						                    <?php
						                    	$allTotal = $allTotal + $item->subtotal;
						                    ?>
						                </tr>
						            @endforeach
						            </tbody>
    							</table>
							</div>
		            
		    				<p class="text-center" style="margin-bottom: 0px;">Total Price: <b>{{ $allTotal }}</b></p>