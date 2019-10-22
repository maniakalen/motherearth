<?php


namespace app\widgets;


use app\assets\FontAwesomeBrands;
use yii\base\InvalidConfigException;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class Dropdown extends \yii\bootstrap\Dropdown
{
    public $dropDownTitle;
    public $inline = false;
    public $style;
    public function run()
    {
        FontAwesomeBrands::register($this->getView());
        return '<div class="dropdown show" '. ($this->inline?'style="display: inline-block;"':'') .'>
              <a class="btn btn-' . $this->style . ' dropdown-toggle" href="#" role="button" id="dd' . $this->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ' . $this->dropDownTitle . '
              </a>
            
              <div class="dropdown-menu" aria-labelledby="dd' . $this->id . '">
                ' . parent::run() . '
              </div>
            </div>';
    }

    /**
     * Renders menu items.
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     * @return string the rendering result.
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    protected function renderItems($items, $options = [])
    {
        $lines = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if (empty($item['items'])) {
                if ($url === null) {
                    $content = $label;
                    Html::addCssClass($itemOptions, ['widget' => 'dropdown-header']);
                } else {
                    Html::addCssClass($linkOptions, ['class' => 'dropdown-item']);
                    $content = Html::a($label, $url, $linkOptions);
                }
            } else {
                $submenuOptions = $this->submenuOptions;
                if (isset($item['submenuOptions'])) {
                    $submenuOptions = array_merge($submenuOptions, $item['submenuOptions']);
                }
                $content = Html::a($label, $url === null ? '#' : $url, $linkOptions)
                    . $this->renderItems($item['items'], $submenuOptions);
                Html::addCssClass($itemOptions, ['widget' => 'dropdown-submenu']);
            }

            $lines[] = $content;
        }

        return implode("\n", $lines);
    }
}