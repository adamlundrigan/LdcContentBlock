LdcContentBlock
=============

---
[![Latest Stable Version](https://poser.pugx.org/adamlundrigan/ldc-content-block/v/stable.svg)](https://packagist.org/packages/adamlundrigan/ldc-content-block) [![Total Downloads](https://poser.pugx.org/adamlundrigan/ldc-content-block/downloads.svg)](https://packagist.org/packages/adamlundrigan/ldc-content-block) [![Latest Unstable Version](https://poser.pugx.org/adamlundrigan/ldc-content-block/v/unstable.svg)](https://packagist.org/packages/adamlundrigan/ldc-content-block) [![License](https://poser.pugx.org/adamlundrigan/ldc-content-block/license.svg)](https://packagist.org/packages/adamlundrigan/ldc-content-block)
[![Build Status](https://travis-ci.org/adamlundrigan/LdcContentBlock.svg?branch=master)](https://travis-ci.org/adamlundrigan/LdcContentBlock)
[![Code Coverage](https://scrutinizer-ci.com/g/adamlundrigan/LdcContentBlock/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/adamlundrigan/LdcContentBlock/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/adamlundrigan/LdcContentBlock/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/adamlundrigan/LdcContentBlock/?branch=master)

---

## What?

LdcContentBlock provides an easy mechanism for adding view layer content blocks that receive and render `ViewModel`s sent to them.  

## What?

An example use case:  Say your module provides a dashboard.  Adding an LdcContentBlock to the page will allow other modules in the system to hook into that block and display their own custom widgets without having to modify the source of the module providing the dashboard itself. 

## How?

1. Install the [Composer](https://getcomposer.org/) package:

    ```
    composer require adamlundrigan/ldc-content-block:1.*@stable
    ```

2. Enable the module (`LdcContentBlock`) in your ZF2 application.

3. Add a content block to one of your view scripts:

    ```
    <?=$this->renderContentBlock('my_block_name'); ?>

4. Configure something to inject into the block

    1. Create a new model to inject and register it ([example](demo/BlockExtensionModule/Module.php#L21))

    2. Add the view model key to the block configuration ([example](demo/BlockExtensionModule/Module.php#L55))

4. Profit!

## Show me!

If you're fortunate enough to be on a *nix system with PHP >=5.4, pop into the `demo` folder and run the setup script (`run.sh`).  This will build the demo application, install the example modules, and start a webserver.  Once that's all done just open your browser and navigate to `http://localhost:8080/` to see the blocks in action!

