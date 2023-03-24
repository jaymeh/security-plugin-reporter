<?php

namespace jaymeh\craftsecurityheaderreporter;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use jaymeh\craftsecurityheaderreporter\models\Settings;

/**
 * security-header-reporter plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @author jaymeh <contact@jaymeh.co.uk>
 * @copyright jaymeh
 * @license https://craftcms.github.io/license/ Craft License
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init()
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('security-header-reporter/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
