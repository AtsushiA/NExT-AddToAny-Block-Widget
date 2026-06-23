/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl, Placeholder } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import { share } from '@wordpress/icons';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { buttonSize, buttonStyle } = attributes;
	const [ isAddToAnyActive, setIsAddToAnyActive ] = useState( true );
	const blockProps = useBlockProps();

	useEffect( () => {
		// Check if AddToAny is available in the window object
		if ( typeof window.a2a !== 'undefined' || typeof window.a2a_config !== 'undefined' ) {
			setIsAddToAnyActive( true );
		}
	}, [] );

	const buttonStyleOptions = [
		{ label: __( 'デフォルト', 'next-addtoany-block' ), value: 'default' },
		{ label: __( 'フローティング', 'next-addtoany-block' ), value: 'floating' },
		{ label: __( 'スタイルなし', 'next-addtoany-block' ), value: 'none' },
	];

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'ボタン設定', 'next-addtoany-block' ) }>
					<RangeControl
						label={ __( 'ボタンサイズ', 'next-addtoany-block' ) }
						value={ buttonSize }
						onChange={ ( value ) => setAttributes( { buttonSize: value } ) }
						min={ 16 }
						max={ 64 }
						step={ 2 }
					/>
					<SelectControl
						label={ __( 'ボタンスタイル', 'next-addtoany-block' ) }
						value={ buttonStyle }
						options={ buttonStyleOptions }
						onChange={ ( value ) => setAttributes( { buttonStyle: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ ! isAddToAnyActive ? (
					<Placeholder
						icon={ share }
						label={ __( 'AddToAny Widget', 'next-addtoany-block' ) }
						instructions={ __( 'AddToAnyプラグインがインストールされていません。このブロックを使用するには、AddToAnyプラグインを有効化してください。', 'next-addtoany-block' ) }
					/>
				) : (
					<Placeholder
						icon={ share }
						label={ __( 'AddToAny Widget', 'next-addtoany-block' ) }
						instructions={ __( '共有ボタンがここに表示されます', 'next-addtoany-block' ) }
					>
						<div className="addtoany-preview">
							<div 
								className="a2a_kit a2a_kit_size_32 a2a_default_style"
								style={ { fontSize: `${buttonSize}px` } }
							>
								<a className="a2a_dd" href="#">
									<span className="dashicons dashicons-share" style={ { fontSize: `${buttonSize}px` } }></span>
								</a>
								<a className="a2a_button_facebook">
									<span className="dashicons dashicons-facebook" style={ { fontSize: `${buttonSize}px` } }></span>
								</a>
								<a className="a2a_button_twitter">
									<span className="dashicons dashicons-twitter" style={ { fontSize: `${buttonSize}px` } }></span>
								</a>
								<a className="a2a_button_email">
									<span className="dashicons dashicons-email" style={ { fontSize: `${buttonSize}px` } }></span>
								</a>
							</div>
							<p className="addtoany-preview-note">
								{ __( '※ プレビュー表示です。実際のボタンはフロントエンドで表示されます。', 'next-addtoany-block' ) }
							</p>
						</div>
					</Placeholder>
				) }
			</div>
		</>
	);
}
