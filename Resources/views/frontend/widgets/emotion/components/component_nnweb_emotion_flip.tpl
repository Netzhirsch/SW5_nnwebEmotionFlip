{block name="widgets_emotion_components_nnweb_emotion_flip"}
	{if $Data.nnwebEmotionFlip_button_link_produkt_id}
		{$link = {url controller="detail" sArticle=$Data.nnwebEmotionFlip_button_link_produkt_id}}
	{else}
		{$link = $Data.nnwebEmotionFlip_back_button_link}
	{/if}
	
	<div class="nnweb_emotion_flip">	
	
		<div class="flipper {$Data.nnwebEmotionFlip_flip_richtung}">
		
			<!-- FRONT -->
			<div class="front" style="
				background-image:url('{$Data.nnwebEmotionFlip_front_hintergrund_bild}');
				background-position:{$Data.nnwebEmotionFlip_front_hintergrund_position};
				background-color:{$Data.nnwebEmotionFlip_front_hintergrund_farbe};"
			>
			
				<div class="wrap">
				
					<!-- FRONT: HEADLINE -->
					{if $Data.nnwebEmotionFlip_front_ueberschrift_anzeigen}
						<{$Data.nnwebEmotionFlip_front_ueberschrift_tag} class="headline {$Data.nnwebEmotionFlip_front_ueberschrift_cls}"
							style="
								text-align:{$Data.nnwebEmotionFlip_front_ueberschrift_textalign};
								background-color:{$Data.nnwebEmotionFlip_front_ueberschrift_hintergrundfarbe};
								color:{$Data.nnwebEmotionFlip_front_ueberschrift_schriftfarbe};
								font-size:{$Data.nnwebEmotionFlip_front_ueberschrift_schriftgroesse};				
							"
						>
							{$Data.nnwebEmotionFlip_front_ueberschrift_text}
						</{$Data.nnwebEmotionFlip_front_ueberschrift_tag}><br>
					{/if}
					
					<!-- FRONT: TEXT -->
					{if $Data.nnwebEmotionFlip_front_text_anzeigen}
						<p class="text {$Data.nnwebEmotionFlip_front_text_cls}"
							style="
								text-align:{$Data.nnwebEmotionFlip_front_text_textalign};
								background-color:{$Data.nnwebEmotionFlip_front_text_hintergrundfarbe};
								color:{$Data.nnwebEmotionFlip_front_text_schriftfarbe};
								font-size:{$Data.nnwebEmotionFlip_front_text_schriftgroesse};				
							"
						>
							{$Data.nnwebEmotionFlip_front_text_text}
						</p>
					{/if}
					
				</div>
				
			</div>
			
			<!-- BACK -->
			<div class="back" style="
				background-image:url('{$Data.nnwebEmotionFlip_back_hintergrund_bild}');
				background-position:{$Data.nnwebEmotionFlip_back_hintergrund_position};
				background-color:{$Data.nnwebEmotionFlip_back_hintergrund_farbe};"
			>
			
				<div class="wrap">	
						
					<!-- BACK: HEADLINE -->
					{if $Data.nnwebEmotionFlip_back_ueberschrift_anzeigen}
						<{$Data.nnwebEmotionFlip_back_ueberschrift_tag} class="headline {$Data.nnwebEmotionFlip_back_ueberschrift_cls}"
							style="
								text-align:{$Data.nnwebEmotionFlip_back_ueberschrift_textalign};
								background-color:{$Data.nnwebEmotionFlip_back_ueberschrift_hintergrundfarbe};
								color:{$Data.nnwebEmotionFlip_back_ueberschrift_schriftfarbe};
								font-size:{$Data.nnwebEmotionFlip_back_ueberschrift_schriftgroesse};				
							"
						>
							{$Data.nnwebEmotionFlip_back_ueberschrift_text}
						</{$Data.nnwebEmotionFlip_back_ueberschrift_tag}><br>
					{/if}
					
					<!-- BACK: TEXT -->
					{if $Data.nnwebEmotionFlip_back_text_anzeigen}
						<p class="text {$Data.nnwebEmotionFlip_back_text_cls}"
							style="
								text-align:{$Data.nnwebEmotionFlip_back_text_textalign};
								background-color:{$Data.nnwebEmotionFlip_back_text_hintergrundfarbe};
								color:{$Data.nnwebEmotionFlip_back_text_schriftfarbe};
								font-size:{$Data.nnwebEmotionFlip_back_text_schriftgroesse};				
							"
						>
							{$Data.nnwebEmotionFlip_back_text_text}
						</p><br>
					{/if}
					
					<!-- BACK: BUTTON -->
					{if $Data.nnwebEmotionFlip_back_button_anzeigen}
						<a
							class="button {$Data.nnwebEmotionFlip_back_button_cls}"
							href="{$link}"
							target="{$Data.nnwebEmotionFlip_back_button_link_target}"
							style="
								text-align:{$Data.nnwebEmotionFlip_back_button_textalign};
								background-color:{$Data.nnwebEmotionFlip_back_button_hintergrundfarbe};
								color:{$Data.nnwebEmotionFlip_back_button_schriftfarbe};
								font-size:{$Data.nnwebEmotionFlip_back_button_schriftgroesse};
							"
						>
							<span>{$Data.nnwebEmotionFlip_back_button_text}</span>
						</a>
					{/if}
					
				</div>
				
			</div>	
				
		</div>
		
	</div>
	
{/block}