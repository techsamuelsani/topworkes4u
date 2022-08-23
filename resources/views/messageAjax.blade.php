<?php $me=Auth::User();?>
<?php
if(count($conversation)==0){ echo "null"; exit;}
?>
@foreach($conversation as $message)
						@if($message->sender_id==$user->id)
                            <?php $message->isSeen=1; $message->save(); ?>
							<!-- MESSAGE PREVIEW -->
							<div class="message-preview messageSender">
								<figure class="user-avatar">
									<img style="width: 40px; height: 40px;" src="\image\{{$user->picLink}}" alt="user-avatar">
								</figure>
								<p class="text-header">{{$user->name}}</p>
								<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
								<p>{{$message->body}}</p>
							</div>
							<!-- /MESSAGE PREVIEW -->
						@endif
					@endforeach