# .bashrc

# User specific aliases and functions

alias rm='rm -i'
alias cp='cp -i'
alias mv='mv -i'

#Append changes to history instead of overwrite full file
alias exit='history -a && exit'

# User specific aliases and functions
alias l='ls -la --color=auto'
alias ls='ls --color=auto'
alias ll='ls -lrt --color=auto'
alias grep='grep --color=auto'

#Reload Bashrc
alias reload='source ~/.bashrc'

# Save history correctly when using multiple terminals
# Dont save duplicate lines or blank lines in to history
export HISTCONTROL=ignoreboth
export HISTSIZE=1000

shopt -s histverify
shopt -s cdable_vars      # if cd arg is not valid, assumes its a var defining a dir
shopt -s cdspell          # autocorrects cd misspellings
shopt -s checkwinsize     # update the value of LINES and COLUMNS after each command if altered
shopt -s cmdhist          # save multi-line commands in history as single line
shopt -s dotglob          # include dotfiles in pathname expansion
shopt -s expand_aliases   # expand aliases
shopt -s extglob          # enable extended pattern-matching features
shopt -s histappend       # append to (not overwrite) the history file
shopt -s hostcomplete     # attempt hostname expansion when @ is at the beginning ofa word
shopt -s nocaseglob       # pathname expansion will be treated as case-insensitive

if [[ $- == *i* ]]
then
    bind '"\e[A": history-search-backward'
    bind '"\e[B": history-search-forward'
    bind '"\C-t": reverse-search-history'
fi

set show-all-if-ambiguous on
set completion-ignore-case on

# sudo apt-get install -y git-core bash-completion
source /etc/bash_completion.d/git-prompt


PS1='[\[\e[93m\]\u\[\e[35m\]@\[\e[39m\]\h\[\e[0m\]:\[\e[33m\]\w\[\e[0m\]]\[$MAGENTA\]$(__git_ps1)\[$WHITE\]\$ '

alias csf="./bin/php-cs-fixer fix --verbose"
export PATH="$PATH:$HOME/.composer/vendor/bin"

alias gs="git status"
alias gp="git pull"
alias gps="git push"

