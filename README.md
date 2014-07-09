Fluidmail
=========

This TYPO3-plugin can be used by developers to create Emailmessages with a Fluid template.

How to use
----------

Inject the FluidMailFactory in your class where you want to use it:
```
/**
* @var \CmsWorks\CwFluidmail\Mail\FluidMailFactoryInterface
* @inject
*/
protected $fluidMailFactory;
```
Create a Fluid-template with 3 (or less) sections: `subject`, `plain` and `html`.

```
<f:section name="subject">
Welcome {user.name}
</f:section>

<f:section name="plain">
Hi {user.name},

Welcome aboard!
</f:section>

<f:section name="html">
Hi <b>{user.name}</b>,

Welcome aboard!
</f:section>
```

Use the function `createFluidMail` of the `FluidMailFactory` to get a `\TYPO3\CMS\Core\Mail\MailMessage`
bootstrapped with a subject and the eventual bodyparts (`plain` and/or `html`):
```
$message = $this->fluidMailFactory->createFluidMail('\path\to\template.html', array(
	'user' => $user,
));
$message->setTo($user->getEmail());
$message->send();
```
